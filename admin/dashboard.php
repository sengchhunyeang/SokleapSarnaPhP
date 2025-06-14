<?php
// connect to database first
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Clinic Sok Leap Metrey</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function openTab(tabName) {
            const contents = document.querySelectorAll('.tabcontent');
            const buttons = document.querySelectorAll('.tab button');
            contents.forEach(el => el.classList.add('hidden'));
            buttons.forEach(el => el.classList.remove('bg-blue-500', 'text-white', 'font-semibold'));

            document.getElementById(tabName).classList.remove('hidden');
            document.querySelector(`[onclick="openTab('${tabName}')"]`)?.classList.add('bg-blue-500', 'text-white', 'font-semibold');
        }
        window.onload = () => openTab('Prescriptions');
    </script>
</head>
<body class="bg-gray-100 p-8 max-w-6xl mx-auto font-sans text-gray-800">
<?php //include 'sidebar.php'; ?>
<h1 class="text-4xl font-semibold text-center mb-10 text-gray-900">
    Dashboard - Clinic Sok Leap Metrey
</h1>

<div class="tab flex justify-center flex-wrap mb-6 gap-2">
    <button onclick="openTab('Prescriptions')" class="px-4 py-2 rounded-md transition-all">
        Prescriptions
    </button>
    <button onclick="openTab('Medicines')" class="px-4 py-2 rounded-md transition-all">
        Medicines
    </button>
    <button onclick="openTab('Invoices')" class="px-4 py-2 rounded-md transition-all">
        Invoices
    </button>
</div>

<!-- Prescriptions Section -->
<div id="Prescriptions" class="tabcontent hidden">
    <h2 class="text-2xl font-semibold mb-6">Prescriptions</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-50 shadow-md rounded-lg">
            <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-gray-900 font-semibold text-left">ID</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Patient Name</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Age</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Gender</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Diagnosis</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Doctor</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Date</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = $conn->query("SELECT * FROM prescriptions");
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='border-t'>";
                echo "<td class='p-3'>{$row['id']}</td>";
                echo "<td class='p-3'>{$row['patient_name']}</td>";
                echo "<td class='p-3'>{$row['age']}</td>";
                echo "<td class='p-3'>{$row['gender']}</td>";
                echo "<td class='p-3'>{$row['diagnosis']}</td>";
                echo "<td class='p-3'>{$row['doctor_name']}</td>";
                echo "<td class='p-3'>{$row['date']}</td>";
                echo "<td class='p-3 space-x-2'>";
                echo "<a href='edit_prescription.php?id={$row['id']}' 
                                   class='text-blue-500 font-semibold hover:underline'>Edit</a>";
                echo "<a href='delete_prescription.php?id={$row['id']}'
                                   onclick='return confirm(\"Are you sure?\")'
                                   class='text-red-500 font-semibold hover:underline'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Medicines Section -->
<div id="Medicines" class="tabcontent hidden">
    <h2 class="text-2xl font-semibold mb-6">Medicines</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-50 shadow-md rounded-lg">
            <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-gray-900 font-semibold text-left">ID</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Prescription ID</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Name</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Morning</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Afternoon</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Evening</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Night</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Qty</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Instructions</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = $conn->query("SELECT * FROM medicines");
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='border-t'>";
                echo "<td class='p-3'>{$row['id']}</td>";
                echo "<td class='p-3'>{$row['prescription_id']}</td>";
                echo "<td class='p-3'>{$row['name']}</td>";
                echo "<td class='p-3'>{$row['morning']}</td>";
                echo "<td class='p-3'>{$row['afternoon']}</td>";
                echo "<td class='p-3'>{$row['evening']}</td>";
                echo "<td class='p-3'>{$row['night']}</td>";
                echo "<td class='p-3'>{$row['quantity']}</td>";
                echo "<td class='p-3'>{$row['instructions']}</td>";
                echo "<td class='p-3 space-x-2'>";
                echo "<a href='edit_medicine.php?id={$row['id']}'
                                   class='text-blue-500 font-semibold hover:underline'>Edit</a>";
                echo "<a href='delete_medicine.php?id={$row['id']}'
                                   onclick='return confirm(\"Are you sure?\")'
                                   class='text-red-500 font-semibold hover:underline'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Invoice Section -->
<div id="Invoices" class="tabcontent hidden">
    <h2 class="text-2xl font-semibold mb-6">Invoices</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-50 shadow-md rounded-lg">
            <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-gray-900 font-semibold text-left">ID</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Prescription ID</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Receive By</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Total Amount</th>
                <th class="p-3 text-gray-900 font-semibold text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = $conn->query("SELECT * FROM invoices");
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='border-t'>";
                echo "<td class='p-3'>{$row['id']}</td>";
                echo "<td class='p-3'>{$row['prescription_id']}</td>";
                echo "<td class='p-3'>{$row['receive_by']}</td>";
                echo "<td class='p-3'>" . number_format($row['total_amount']) . " ៛</td>";
                echo "<td class='p-3 space-x-2'>";
                echo "<a href='edit_invoice.php?id={$row['id']}'
                                   class='text-blue-500 font-semibold hover:underline'>Edit</a>";
                echo "<a href='delete_invoice.php?id={$row['id']}'
                                   onclick='return confirm(\"Are you sure?\")'
                                   class='text-red-500 font-semibold hover:underline'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
