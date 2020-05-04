<?php
// +------------------------------------------------------------------------------------
// | Desc: Exception Adapter
// + -----------------------------------------------------------------------------------
// | By: PhpStorm 
// +------------------------------------------------------------------------------------
// | Date: 2020/5/4 
// + -----------------------------------------------------------------------------------
// | Author: cleverstone
// +------------------------------------------------------------------------------------

namespace clever\contract;

use Exception as BaseException;

class Exception extends BaseException
{
    /**
     * The name of the current exception handler.
     *
     * @return string
     * @author cleverstone
     */
    public function name()
    {
        return static::class;
    }
}