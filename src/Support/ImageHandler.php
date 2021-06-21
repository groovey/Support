<?php
namespace Pandango\Support;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImageHandler
{

    /**
     * Save the image and include a resized copy of it
     */
    public function save(array $data = [])
    {
        $image       = $data['image'];
        $storagePath = $data['storagePath'] ?? null;
        $thumbnail   = $data['thumbnail'] ?? true;
        $toFilename  = $data['toFilename'];

        if ($image) {

            // Get filename info
            $filenameWithExtension      = $image->getClientOriginalName();
            $extension                  = $image->getClientOriginalExtension();
            $filename                   = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $formattedFilename          = $toFilename . '.' . $extension;
            $formattedThumbnailFilename = $toFilename . '-t.' . $extension;
            $fullImagePath              = $storagePath . '/' . $formattedFilename;

            if (!($storagePath && $formattedFilename)) {
                abort(403, 'Missing file parameters data on ImageHandler.');
            }

            // Save the image file
            $success = $image->move($storagePath, $formattedFilename);

            if ($success && $thumbnail == true) {
                $width  = $data['width'];
                $height = $data['height'];

                if (!($width && $height)) {
                    abort(403, 'Missing width & height parameters data on ImageHandler.');
                }

                // Resize the image file and append _thumbnail
                $img = Image::make($fullImagePath)->resize($width, $height);
                $img->save($storagePath . '/' . $formattedThumbnailFilename);
            }

            return $formattedFilename;
        } else {
            return null;
        }
    }

    /**
     * Deletes the image with an option to delete the thumbnail
     */
    public function delete(array $data)
    {
        $image     = $data['image'];
        $thumbnail = $data['thumbnail'] ?? true;

        if (!$image) {
            return false;
        }

        $storagePath    = $data['storagePath'];
        $imagePath      = $storagePath . '/' . $image;
        $infoPath       = pathinfo($imagePath);
        $imageExtension = $infoPath['extension'];
        $imageFilename  = $infoPath['filename'];

        if (File::exists($imagePath)) {
            unlink($imagePath);
        }

        if ($thumbnail == true) {
            $imageThumbnailPath = $storagePath . '/' . $imageFilename . '-t.' . $imageExtension;
            if (File::exists($imageThumbnailPath)) {
                unlink($imageThumbnailPath);
            }
        }

        return true;
    }
}