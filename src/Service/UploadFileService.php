<?php 

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadFileService
{
    public function __construct(private string $imagesDirectory, private SluggerInterface $slugger){}

    public function upload(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = sprintf('%s-%s.%s', $safeFilename, uniqid(), $file->guessExtension());
        try {
            $file->move($this->imagesDirectory, $fileName);
        } catch (FileException $e) {

        }

        return $fileName;
    }
}