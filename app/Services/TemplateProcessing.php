<?php

namespace App\Services;

use PhpOffice\PhpWord\TemplateProcessor;

class TemplateProcessing extends TemplateProcessor
{
    
    /*
     * Replace a Existing image
     *
     * @param string $search
     * @param string $replace
     */
    public function replaceImage($search, $replace)
    {
        // Sanity check
        if (!file_exists($replace))
        {
            return;
        }

        // Delete current image
        $this->zipClass->deleteName('word/media/' . $search);

        // Add a new one
        //$this->zipClass->pclzipAddFile($imgPath, 'word/media/' . $imgName);
        $this->zipClass->pclzipAddFile($replace, 'word/media/' . $search);
    }
}