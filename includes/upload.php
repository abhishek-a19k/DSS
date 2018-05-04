 <?php

class  Media
{

    public $imageInfo;
    public $fileName;
    public $fileType;
    public $fileTempPath;
    //Set destination for upload
    public $userPath = SITE_ROOT . DS . '..' . DS . 'uploads/users';
    public $productPath = SITE_ROOT . DS . '..' . DS . 'uploads/products';


    public $errors = array();
    public $upload_errors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.'
    );
    public $upload_extensions = array(
        'gif',
        'jpg',
        'jpeg',
        'png',
    );

    public function file_ext($filename)
    {
        $ext = strtolower(substr($filename, strrpos($filename, '.') + 1));
        if (in_array($ext, $this->upload_extensions)) {
            return true;
        }
    }

    public function upload($file)
    {
        if (!$file || empty($file) || !is_array($file)):
            $this->errors[] = "No file was uploaded.";
            return false;
        elseif ($file['error'] != 0):
            $this->errors[] = $this->upload_errors[$file['error']];
            return false;
        elseif (!$this->file_ext($file['name'])):
            $this->errors[] = 'File not right format ';
            return false;
        else:
            $this->imageInfo = getimagesize($file['tmp_name']);
            $this->fileName = basename($file['name']);
            $this->fileType = $this->imageInfo['mime'];
            $this->fileTempPath = $file['tmp_name'];
            return true;
        endif;

    }

    public function process()
    {

        if (!empty($this->errors)):
            return false;
        elseif (empty($this->fileName) || empty($this->fileTempPath)):
            $this->errors[] = "The file location was not available.";
            return false;
        elseif (!is_writable($this->productPath)):
            $this->errors[] = $this->productPath . " Must be writable!!!.";
            return false;
        elseif (file_exists($this->productPath . "/" . $this->fileName)):
            $this->errors[] = "The file {$this->fileName} already exists.";
            return false;
        else:
            return true;
        endif;
    }
    /*--------------------------------------------------------------*/
    /* Function for Process media file
    /*--------------------------------------------------------------*/
    public function process_media()
    {
        if (!empty($this->errors)) {
            return false;
        }
        if (empty($this->fileName) || empty($this->fileTempPath)) {
            $this->errors[] = "The file location was not available.";
            return false;
        }

        if (!is_writable($this->productPath)) {
            $this->errors[] = $this->productPath . " Must be writable!!!.";
            return false;
        }

        if (file_exists($this->productPath . "/" . $this->fileName)) {
            $this->errors[] = "The file {$this->fileName} already exists.";
            return false;
        }

        if (move_uploaded_file($this->fileTempPath, $this->productPath . '/' . $this->fileName)) {

            if ($this->insert_media()) {
                unset($this->fileTempPath);
                return true;
            }

        } else {

            $this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
            return false;
        }

    }

}
?>

