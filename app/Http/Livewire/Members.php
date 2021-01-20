<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Member;

class Members extends Component
{
    public $members,  $member_id, $nama, $nim, $konsentrasi, $judul, $proposal, $pembimbing, $status, $action;
    public $isModal = 0;

  	//load view
    public function render()
    {
        $this->members = Member::orderBy('created_at', 'DESC')->get(); //MEMBUAT QUERY UNTUK MENGAMBIL DATA
        return view('livewire.members'); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER /RESOURSCES/VIEWS/LIVEWIRE
    }

    //approve
    public function create()
    {
        //kosongkan field
        $this->resetFields();
        //buka modal
        $this->openModal();
    }

    //menutup modal
    public function closeModal()
    {
        $this->isModal = false;
    }

    //open modal
    public function openModal()
    {
        $this->isModal = true;
    }

    //Reset
    public function resetFields()
    {
        $this->nama = '';
        $this->nim = '';
        $this->konsentrasi = '';
        $this->judul = '';
        $this->proposal = '';
        $this->pembimbing = '';
        $this->status = '';
        $this->action = '';
    }

    //METHOD STORE untuk update data
    public function store()
    {
 
        $this->validate([
            'pembimbing' => 'required|string',
            'status' => 'required|string'
        ]);


        Member::updateOrCreate(['id' => $this->member_id], [
            'pembimbing' => $this->pembimbing,
            'status' => $this->status,
        ]);

      
        session()->flash('message', $this->member_id ? $this->nama . ' Diperbaharui': $this->nama . ' Ditambahkan');
        $this->closeModal(); 
        $this->resetFields(); 
    }


    public function delete($id)
    {
        $member = Member::find($id); 
        $member->delete(); 
        session()->flash('message', $member->nama . ' Dihapus'); 
    }
}