<?php
    $cdir = scandir(".");
    foreach ($cdir as $key => $value)
    {
        if(preg_match('/xml/', $value)){
            $dom = new DOMDocument();
            $dom->load( $value);
            foreach ($dom->getElementsByTagName('item') as $node) { 
                print_r($node);
                foreach ($node->getElementsByTagName('postmeta') as $oMeta) {
                    if($oMeta->getElementsByTagName("meta_key")->item(0)->nodeValue == "_thumbnail_id"){
                        $sNodeId = $oMeta->getElementsByTagName("meta_value")->item(0)->nodeValue;
                        $sGuid = "";
                        $sTitle = "";
                        $sAlt = "";
                        $sCaption = "";
                        foreach ($dom->getElementsByTagName('item') as $imageNode) { 
                            $sPostId = $imageNode->getElementsByTagName("post_id")->item(0)->nodeValue;
                            if($sPostId == $sNodeId){
                                $sGuid = $imageNode->getElementsByTagName("guid")->item(0)->nodeValue;
                                $sTitle = $imageNode->getElementsByTagName("title")->item(0)->nodeValue;
                                foreach ($imageNode->getElementsByTagName('encoded') as $captionNode) { 
                                    $sCaption .= $captionNode->nodeValue;
                                }
                                foreach ($imageNode->getElementsByTagName('postmeta') as $oMeta) {
                                    if($oMeta->getElementsByTagName("meta_key")->item(0)->nodeValue == "_wp_attachment_image_alt"){
                                        $sAlt = $oMeta->getElementsByTagName("meta_value")->item(0)->nodeValue;
                                        break;
                                    }
                                }
                                break;
                            }
                        }
                        if($sGuid != ""){
                            $content = $node->getElementsByTagName("encoded")->item(0);
                            $sContent = $content->nodeValue;
                            $sNewContent = <<<EX
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="$sGuid" alt="$sAlt" title="$sTitle" class="wp-image-27"/><figcaption>$sCaption</figcaption></figure>
<!-- /wp:image -->
$sContent;
EX;
                            $oNew = $dom->createElement("content:encoded");
                            $oNew->appendChild($dom->createCDATASection($sNewContent));
                            $node->replaceChild($oNew, $content);
                        }

                    }
                }
            }
            $file = $dom->save( "processed_" . $value );
        
        }
        
    }

    