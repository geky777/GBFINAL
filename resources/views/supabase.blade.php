<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supabase Integration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Supabase Data Management</h1>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Add New Record</h2>
            <form id="addForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="description" name="description" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                    Add Record
                </button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Current Records</h2>
            <div id="records-container" class="space-y-2">
                <p class="text-gray-500">Loading records...</p>
            </div>
        </div>
    </div>

    <script>
        const API_BASE = '/supabase/data';
        
        // Load records
        async function loadRecords() {
            try {
                const response = await fetch(API_BASE);
                const result = await response.json();
                
                const container = document.getElementById('records-container');
                
                if (result.success) {
                    if (result.data.length === 0) {
                        container.innerHTML = '<p class="text-gray-500">No records found.</p>';
                    } else {
                        container.innerHTML = result.data.map(record => `
                            <div class="border border-gray-200 rounded-lg p-4 flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold">${record.name || 'Untitled'}</h3>
                                    <p class="text-gray-600">${record.description || 'No description'}</p>
                                    <p class="text-sm text-gray-400">ID: ${record.id}</p>
                                </div>
                                <button onclick="deleteRecord('${record.id}')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition-colors text-sm">
                                    Delete
                                </button>
                            </div>
                        `).join('');
                    }
                } else {
                    container.innerHTML = `<p class="text-red-500">Error: ${result.message}</p>`;
                }
            } catch (error) {
                document.getElementById('records-container').innerHTML = `<p class="text-red-500">Error loading data: ${error.message}</p>`;
            }
        }
        
        // Add record
        document.getElementById('addForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            const data = {
                name: formData.get('name'),
                description: formData.get('description'),
                created_at: new Date().toISOString()
            };
            
            try {
                const response = await fetch(API_BASE, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    e.target.reset();
                    loadRecords();
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                alert('Error adding record: ' + error.message);
            }
        });
        
        // Delete record
        async function deleteRecord(id) {
            if (!confirm('Are you sure you want to delete this record?')) return;
            
            try {
                const response = await fetch(`${API_BASE}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    }
                });
                
                const result = await response.json();
                
                if (result.success) {
                    loadRecords();
                } else {
                    alert('Error: ' + result.message);
                }
            } catch (error) {
                alert('Error deleting record: ' + error.message);
            }
        }
        
        // Load records on page load
        loadRecords();
    </script>
</body>
</html>
