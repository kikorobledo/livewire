<?php

namespace App\Http\Livewire\DataTable;

trait WithCaheRows{

    protected $useCache = false;

    public function useCacheRows(){

        $this->useCache = true;
    }

    public function cache($callback){

        $cacheKey = $this->id;

        if($this->useCache && cache()->has($cacheKey)){

            return cache()->get($cacheKey);

        }

        $results = $callback();

        cache()->put($cacheKey, $results);

        return $results;

    }
}
