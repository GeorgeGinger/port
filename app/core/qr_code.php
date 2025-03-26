<?php

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\OpenSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

function qrCodeGenerator($data)
	{
		
		$codeSize = 300;

		$builder = new Builder(
			writer: new PngWriter(),
			writerOptions: [],
			validateResult: false,
			data: $data["data"],
			encoding: new Encoding('UTF-8'),
			errorCorrectionLevel: ErrorCorrectionLevel::High,
			size: 300,
			margin: 10,
			roundBlockSizeMode: RoundBlockSizeMode::Margin,
			// logoPath: __DIR__.'/assets/symfony.png',
			logoResizeToWidth: 50,
			logoPunchoutBackground: true,
			labelText: $data["label"],
			labelFont: new OpenSans(20),
			labelAlignment: LabelAlignment::Center
		);
		
		$result = $builder->build();

		$dataUri = $result->getDataUri();
		$result->saveToFile('./objednavky/qr_codes/'.$data["order_id"].'_qrcode.png');
		return $dataUri;
	}