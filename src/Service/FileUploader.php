<?php

namespace App\Service;

use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    public function __construct(
        private string $targetDirectory,
        private SluggerInterface $slugger,
    ) {
    }

    public function upload(UploadedFile $file, object $entity, string $fieldName, string $folder): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory() . '/' . $folder, $fileName);
        } catch (FileException $e) {
            throw new Exception('There was a problem uploading your file. Please try again.');
        }

        // deletes the old file
        $this->removeOldFile($entity, $fieldName, $folder);

        return $fileName;
    }

    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }

    private function removeOldFile(object $entity, string $fieldName, string $folder): void
    {
        $getter = 'get' . ucfirst($fieldName);
        $oldFile = $entity->$getter();

        if ($oldFile) {
            $oldFilePath = $this->getTargetDirectory() . '/' . $folder . '/' . $oldFile;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
    }
}