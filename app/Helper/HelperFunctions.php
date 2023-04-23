<?php
use PhpParser\Node\Stmt\Throw_;

function jsonResponse($status, $data = null) {

    $dataType = gettype($data);


    if($data && $dataType !== 'string' && $dataType !== 'object') {  
        throw new Exception("Data value must be a string or object");
    }


    $dataKey = 'message';
    $dataValue = 'Data Successfully Saved!';


    switch($dataType)
    {
        case 'object':
            $dataKey = 'data';
            $dataValue = $data;
            break;

        case 'string':
            $dataKey = $status === 200 ? 'message' : 'err_message';
            $dataValue =  $data;
            break;

        default:
            $dataKey = $status === 200 ? 'message' : 'err_message';
            $dataValue =  $status === 200 ? 'Data Successfully Saved!' : 'Opps. Something Went Wrong';
            break;
    }


    return response()->json([$dataKey => $dataValue], $status);
}