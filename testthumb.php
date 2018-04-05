<?php
    function genPdfThumbnail($source, $target)
    {
        
        $target = dirname($source).DIRECTORY_SEPARATOR.$target;
        $im     = new Imagick($source."[0]"); // 0-first page, 1-second page
       // $im->setImageColorspace(255); // prevent image colors from inverting
        $im->setimageformat("jpeg");
        $im->thumbnailimage(300,300,true, false); // width and height
        $im->writeimage($target);
        $im->clear();
        $im->destroy();
    }
	
	//genPdfThumbnail($_SERVER['DOCUMENT_ROOT'] . '/news/archives/NATimes10.pdf','my.jpg'); // generates /uploads/my.jpg
	$filename = "something.pdf";
	$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
	echo $withoutExt;
	?>