<?php
    $main_doc = new DOMDocument();
    $sRootFile = "apr3combined.wordpress1.2021-04-03.34.xml";
    $main_doc->load( $sRootFile );
    $root = $main_doc->getElementsByTagName( "rss" )->item(0);

    $cdir = scandir(".");
    foreach ($cdir as $key => $value)
    {
        if(preg_match('/xml/', $value) && $value != $sRootFile){
            $merge_doc = new DOMDocument();
            $merge_doc->load( $value);
            $items = $merge_doc->getElementsByTagName( "item" );
            
            for ( $i = 0; $i < $items->length; $i++ ) {
                $node = $items->item( $i );
                $import = $main_doc->importNode( $node, true );
                $root->appendChild( $import );
            }
            
        }
        
    }

    $file = $main_doc->save( "mergefile.xml" );
