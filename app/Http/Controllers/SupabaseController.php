<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;

class SupabaseController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    /**
     * Display data from Supabase
     */
    public function index()
    {
        try {
            // Example: Get all records from a 'books' table
            $data = $this->supabase->get('your_table_name');
            
            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store data to Supabase
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            
            // Example: Insert into a 'books' table
            $result = $this->supabase->post('your_table_name', $data);
            
            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update data in Supabase
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            
            // Example: Update record in 'books' table
            $result = $this->supabase->put('your_table_name', $data, [
                'id' => 'eq.' . $id
            ]);
            
            return response()->json([
                'success' => true,
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete data from Supabase
     */
    public function destroy($id)
    {
        try {
            // Example: Delete record from 'books' table
            $result = $this->supabase->delete('your_table_name', [
                'id' => 'eq.' . $id
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
