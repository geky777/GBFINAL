<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opening Iliad</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&family=Cormorant+Garamond:wght@300;400&display=swap" rel="stylesheet">

    <style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        width: 100vw;
        overflow: hidden;
        position: relative;
        font-family: 'Poppins', sans-serif;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: url('/images/iliad-bg.jpg') no-repeat center center/cover;
        filter: blur(6px) brightness(0.5);
        z-index: -1;
    }

    .fade-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        opacity: 0;
        transition: opacity 5.0s ease;
        z-index: 1;
    }

    .show {
        opacity: 1;
    }

    .title {
        font-family: 'Cinzel Decorative', serif;
        font-size: 8rem;
        font-weight: 700;
        color: #d6b349ff;
        text-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    }

    .subtitle {
        font-family:'Cinzel Decorative', serif; 
        font-size: 1.3rem;
        margin-top: 10px;
        color: #fff;
        text-shadow: 0 3px 8px rgba(0,0,0,0.45);
    }

    @media (max-width: 768px) {
        .title {
            font-size: 2.5rem;
        }
        .subtitle {
            font-size: 1rem;
        }
    }
</style>

    <script>
        // Text fade-in after 1.5 seconds, then redirect to /iliad automatically.
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(() => {
                document.querySelector(".fade-text").classList.add("show");
            }, 1500);

            // Redirect 3 seconds after fade-in (4.5 seconds total)
            setTimeout(() => {
                window.location.href = "/iliad";
            }, 4500);
        });
    </script>
</head>

<body>

    <div class="fade-text">
        <div class="title">ILIAD</div>
        <div class="subtitle">by Homer</div>
    </div>

</body>
</html>