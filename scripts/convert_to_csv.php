<?php 
    require_once('./../_config.php');
    require_once './../includes/lib/PHPSpreadsheet/vendor/autoload.php';


	$dirExcel = './../uploads/data';
	$dirCSV = [
		'./../uploads/data/csv-master',
		'./../uploads/data/csv-s-list'
	];

	$fileNames = [
		"Parivartan.NRC.2022.Master.File.xlsx",
		"S.List.2022.Master.File.xlsx",
	];

	foreach ($fileNames as $fileIndex => $fileName) {
		$inputFileName = $dirExcel . '/' . $fileName;
		print "Input file : ". str_replace("./../", "", $inputFileName) . "<br>";

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
		$reader->setReadDataOnly(true);
		$spreadsheet = $reader->load($inputFileName);

		$i = 0;
		$sheetCount = $spreadsheet->getSheetCount();
		print "This file contains ". $sheetCount ." sheets" . "<br>";
		$sheetName = $spreadsheet->getSheetNames();
		while($i < $sheetCount) 
		{
			$spreadsheet->setActiveSheetIndex($i);

			$outputFileName = $dirCSV[$fileIndex].'/'. $sheetName[$i].'.'.'csv';

			$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Csv");
			$writer->setSheetIndex($i);
			$writer->save($outputFileName);

			print "created file : ".$sheetName[$i]."<br>";

			++$i;
		}
		print "<br><br>" ;

		// // Initialize archive object
		// $zip = new ZipArchive();
		// $zip->open($dirExcel . '/zip' . '/' . str_replace(".xlsx", "", $fileName) . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

		// // Create recursive directory iterator
		// /** @var SplFileInfo[] $files */
		// $files = new RecursiveIteratorIterator(
		// 	new RecursiveDirectoryIterator($dirCSV[$fileIndex]),
		// 	RecursiveIteratorIterator::LEAVES_ONLY
		// );

		// foreach ($files as $name => $file)
		// {
		// 	// Skip directories (they would be added automatically)
		// 	if (!$file->isDir() && $file->getFilename() != '.DS_Store')
		// 	{
		// 		// Get real and relative path for current file
		// 		$filePath = $file->getRealPath();
		// 		$relativePath = explode("\\", $filePath);
		// 		$relativePath = array_pop($relativePath);

		// 		// Add current file to archive
		// 		$zip->addFile($filePath, $relativePath);
		// 	}
			
		// }
		// // Zip archive will be created only after closing object
		// $zip->close();

	}
?>