<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">



    <!-- DataTables Bootstrap 5 Integration -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.4.1/css/rowReorder.dataTables.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

    <style>
        .modal {
            z-index: 1050 !important;
        }

        .large-modal {
            max-width: 80%;
        }

        .custom-thumbnail {
            max-width: 80px;
            height: auto;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .custom-large-image {
            width: 100%;
            /* Make the image take the full width of its container */
            height: auto;
            /* Maintain the aspect ratio */
            max-height: 400px;
            /* Adjust this value based on your modal size */
            object-fit: contain;
            /* Ensures the image fits without cropping */
            border: 2px solid #ddd;
            /* Optional: Adds a subtle border */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Optional: Adds depth */
            display: block;
            margin: 0 auto;
            /* Centers the image */
            padding: 5px;
            /* Optional spacing */
        }

        .custom-large-image {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: contain;
            border: 2px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: block;
            margin: 0 auto;
            padding: 5px;
            /* Fade-in animation for new product rows */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            .fade-in {
                animation: fadeIn 0.5s ease-out;
            
            /* Fade-out effect for removal */
            .fade-out {
                opacity: 0;
                transition: opacity 0.5s ease-out;
            }
            /* Custom inline totals input style */
            .totals-input {
                width: 100px;
                display: inline-block;
                vertical-align: middle;
                text-align: right;
            }
            .totals-label {
                margin-bottom: 0;
                margin-right: 5px;
                font-weight: 500;
            }
    </style>
</head>
