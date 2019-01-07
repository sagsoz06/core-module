<?php

namespace Modules\Core\Database\MariaDB;

use Illuminate\Support\Str;
use Illuminate\Database\Query\Grammars\MySqlGrammar;

class QueryGrammar extends MySqlGrammar
{

    protected function wrapJsonSelector($value)
    {
        if (Str::contains($value, '->>')) {
            $delimiter = '->>';
            $format = 'JSON_UNQUOTE(JSON_EXTRACT(%s, \'$.%s\'))';
        } else {
            $delimiter = '->';
            $format = 'JSON_EXTRACT(%s, \'$.%s\')';
        } 

        $path = explode($delimiter, $value);

        $field = collect(explode('.', array_shift($path)))->map(function ($part) {
            return $this->wrapValue($part);
        })->implode('.');

        return sprintf($format, $field, collect($path)->map(function ($part) {
            return '"'.$part.'"';
        })->implode('.'));
    }

    //make table.field->json selects work
    public function wrap($value, $prefixAlias = false)
    {
        $mysqlWrap = parent::wrap($value, $prefixAlias);

        if(Str::contains($mysqlWrap, '.JSON_EXTRACT')) {

            if (Str::contains($value, '->>')) {
                $delimiter = '->>';
                $format = 'JSON_UNQUOTE(JSON_EXTRACT(%s, \'$.%s\'))';
            } else {
                $delimiter = '->';
                $format = 'JSON_EXTRACT(%s, \'$.%s\')';
            }

            $path = explode($delimiter, $value);

            $field = collect(explode('.', array_shift($path)))->map(function ($part) {
                return $this->wrapValue($part);
            })->implode('.');

            return sprintf($format, $field, collect($path)->map(function ($part) {
                    return '"'.$part.'"';
                })->implode('.')
            );
        }

        return $mysqlWrap;
    }
}
