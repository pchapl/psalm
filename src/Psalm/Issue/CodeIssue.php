<?php
namespace Psalm\Issue;

use Psalm\CodeLocation;

abstract class CodeIssue
{
    const CODE_EXCEPTION = 1;

    /**
     * @var CodeLocation
     */
    protected $code_location;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param string        $message
     * @param CodeLocation  $code_location
     */
    public function __construct($message, CodeLocation $code_location)
    {
        $this->code_location = $code_location;
        $this->message = $message;
    }

    /**
     * @return CodeLocation
     */
    public function getLocation()
    {
        return $this->code_location;
    }

    /**
     * @return string
     */
    public function getShortLocation()
    {
        $previous_text = '';

        if ($this->code_location->previous_location) {
            $previous_location = $this->code_location->previous_location;
            $previous_text = ' from ' . $previous_location->file_name . ':' . $previous_location->getLineNumber();
        }

        return $this->code_location->file_name . ':' . $this->code_location->getLineNumber() . $previous_text;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->code_location->file_path;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->code_location->file_name;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
