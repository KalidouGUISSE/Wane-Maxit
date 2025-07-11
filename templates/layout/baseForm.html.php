

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXITSA - Créer un Compte</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .upload-area {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            border-color: #f97316;
            background-color: #fef3f2;
        }
        .upload-area.dragover {
            border-color: #f97316;
            background-color: #fef3f2;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto p-6">
        <!-- Header -->
        <div class="flex items-center mb-8">
            <div class="text-2xl font-bold text-gray-900">MAXITSA</div>
        </div>

        <!-- Main Form -->
        <?php
                echo $containteForLayoute;
            ?>
    </div>
    <!-- <script src="script.js"></script> -->
</body>
</html>