<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function getBase64Image($image)
    {
        // Handle the uploaded file
        $imagePath = $image->getRealPath();
    
        // Define the directory to save the WebP images
        $directory = storage_path('app/images');
    
        // Check if the directory exists, if not, create it
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true); // Create the directory with appropriate permissions
        }
    
        // Check the file extension
        $extension = strtolower($image->getClientOriginalExtension());
        $webpPath = $directory . '/' . uniqid('image_', true) . '.webp'; // Unique name for WebP file
    
        // Create the image resource based on the file extension
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $imageResource = imagecreatefromjpeg($imagePath);
                break;
            case 'png':
                $imageResource = imagecreatefrompng($imagePath);
                break;
            case 'gif':
                $imageResource = imagecreatefromgif($imagePath);
                break;
            case 'webp':
                return base64_encode(file_get_contents($imagePath)); // Already in WebP format
            default:
                throw new Exception('Unsupported image type: ' . $extension);
        }
    
        // Check if image resource creation was successful
        if ($imageResource === false) {
            throw new Exception('Failed to create image resource from the uploaded file.');
        }
    
        // Convert palette images to true color (if applicable)
        if (imageistruecolor($imageResource) === false) {
            imagepalettetotruecolor($imageResource);
        }
    
        // Save the image in WebP format and check for success
        if (!imagewebp($imageResource, $webpPath, 90)) { // Set quality to 90
            // Log the error
            error_log('GD WebP encoding failed for image: ' . $webpPath);
            throw new Exception('Failed to convert image to WebP format.');
        }
    
        // Clean up
        imagedestroy($imageResource);
    
        // Convert the WebP image to Base64
        $base64Image = base64_encode(file_get_contents($webpPath));
    
        return $base64Image;
    }
    
}