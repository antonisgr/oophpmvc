<?php namespace Oophpmvc;

interface Crudable
{
    public function create($data);
    public function update($data);
    public function delete($id);

}
