
<?php
require_once '../includes/db.php';
$type = $_GET['type'] ?? 'csv';
$result = $conn->query("SELECT * FROM finances");

if ($type === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="finance.csv"');
    $out = fopen("php://output", 'w');
    fputcsv($out, ['Title', 'Amount', 'Type', 'Date']);
    while ($row = $result->fetch_assoc()) {
        fputcsv($out, [$row['title'], $row['amount'], $row['type'], $row['date']]);
    }
    fclose($out);
} elseif ($type === 'pdf') {
    require_once('../includes/tcpdf.php'); // Placeholder
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 12);
    $html = "<h1>Finance Report</h1><table border='1'><tr><th>Title</th><th>Amount</th><th>Type</th><th>Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $html .= "<tr><td>{$row['title']}</td><td>{$row['amount']}</td><td>{$row['type']}</td><td>{$row['date']}</td></tr>";
    }
    $html .= "</table>";
    $pdf->writeHTML($html);
    $pdf->Output("finance.pdf", 'D');
}
?>
