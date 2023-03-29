<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;


class ItemController extends BaseController
{
    //ADMIN
    public function item_list_admin()
    {
        $itemModel = new ItemModel();
        $getItem = $itemModel->findAll();
        return view('/admin/dashboard-item', [
            'getItem' => $getItem
        ]);
    }

    public function item_create_post_admin(){
        $validationRules = [
            'umkm' => 'required',
            'category' => 'required',
            'name_item' => 'required',
            'img' => 'uploaded[img]|max_size[img,1024]|mime_in[img,image/png,image/jpeg]',
            'stock' => 'required|numeric',
            'price' => 'required',
            'description' => 'required'
        ];
    
        $validationMessages = [
            'umkm' => [
                'required' => 'UMKM field is required'
            ],
            'category' => [
                'required' => 'Category field is required'
            ],
            'name_item' => [
                'required' => 'Name item field is required'
            ],
            'img' => [
                'uploaded' => 'Image field is required',
                'max_size' => 'The size of the image must not exceed 1 MB',
                'mime_in' => 'The image must be a PNG or JPEG'
            ],
            'stock' => [
                'required' => 'Stock field is required',
                'numeric' => 'Stock field must be a number'
            ],
            'price' => [
                'required' => 'Price field is required',
            ],
            'description' => [
                'required' => 'Description field is required'
            ]
        ];
    
        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $umkm = $this->request->getVar('umkm');
        $category = $this->request->getVar('category');
        $name_item = $this->request->getVar('name_item');
        $img = $this->request->getFile('img');
        $stock = $this->request->getVar('stock');
        $price = $this->request->getVar('price');
        $description = $this->request->getVar('description');
    
        // Check if the file was uploaded successfully
        if ($img->getError() == UPLOAD_ERR_OK) {
            // Get the file name and extension
            $imageName = $img->getName();
            $imageExt = $img->getClientExtension();
    
            // Generate a unique name for the file
            $newName = uniqid('', true) . '.' . $imageExt;
    
            // Move the file to the public/images directory
            $img->move('images', $newName);
    
            // Store the path in the database
            $imgPath = base_url('images/' . $newName);
        } else {
            $imgPath = '';
        }
    
        $itemModel = new ItemModel();
        $InsertResult = $itemModel->createItem([
            'umkm' => $umkm,
            'category' => $category,
            'name_item' => $name_item,
            'img' => $imgPath,
            'stock' => $stock,
            'price' => $price,
            'description' => $description,
        ]);
    
        if (!empty($InsertResult['uuid'])) {
            return redirect()->to('/admin/dashboard//item')->with('success', 'success adding item');
        } else {
            return redirect()->to('/admin/dashboard/item')->with('errors', 'failed add item');
        }
    }

    public function item_edit_post_admin($item_uuid){
        $itemModel = new ItemModel();
        $getItem = $itemModel
            ->where('uuid', $item_uuid)
            ->first();
        if(!empty($getItem)){
            $validationRules = [
                'umkm' => 'required',
                'category' => 'required',
                'name_item' => 'required',
                'img' => 'uploaded[img]|mime_in[img,image/png,image/jpeg,image/jpg]',
                'stock' => 'required|numeric',
                'price' => 'required',
                'description' => 'required'
            ];
        
            $validationMessages = [
                'umkm' => [
                    'required' => 'UMKM field is required in edit forms'
                ],
                'category' => [
                    'required' => 'Category field is required in edit forms'
                ],
                'name_item' => [
                    'required' => 'Name item field is required in edit forms'
                ],
                'img' => [
                    'uploaded' => 'Image field is required in edit forms',
                    'mime_in' => 'The image must be a PNG or JPEG or JPG in edit forms',
                ],
                'stock' => [
                    'required' => 'Stock field is required in edit forms',
                    'numeric' => 'Stock field must be a number in edit forms'
                ],
                'price' => [
                    'required' => 'Price field is required in edit forms',
                ],
                'description' => [
                    'required' => 'Description field is required in edit forms'
                ]
            ];
            $img = $this->request->getFile('img');
            if ($img->getError() == UPLOAD_ERR_OK) {
                // Get the file name and extension
                $imageName = $img->getName();
                $imageExt = $img->getClientExtension();
        
                // Generate a unique name for the file
                $newName = uniqid('', true) . '.' . $imageExt;
        
                // Move the file to the public/images directory
                $img->move('images', $newName);
        
                // Store the path in the database
                $imgPath = base_url('images/' . $newName);
            } else {
                $imgPath = '';
            }
            if (!$this->validate($validationRules, $validationMessages)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            $itemModel->where('uuid', $item_uuid)->set([
                'umkm' => $this->request->getVar('umkm'),
                'category' => $this->request->getVar('category'),
                'name_item' => $this->request->getVar('name_item'),
                'img' => $imgPath,
                'stock' => $this->request->getVar('stock'),
                'price' => $this->request->getVar('price'),
                'description' => $this->request->getVar('description'),
            ])->update();
            return redirect()->to('/admin/dashboard/item')->with('success', 'success updating item');
        }
        else return redirect()->to('/admin/dashboard/item')->with('error', 'failed when updating item');
    }

    public function item_delete_admin($item_uuid){
        $itemModel = new ItemModel();
        $getItem = $itemModel->where('uuid', $item_uuid)->first();
        if(!empty($getItem)){
            $itemModel->where('uuid', $item_uuid)->delete();
            return redirect()->to('/admin/dashboard/item')->with('success', 'success deleting item');
        }
        else return redirect()->to('/admin/dashboard/item')->with('error', 'error when deleting item');
    }


    //MEMBER
    public function item_list_member(){
        $itemModel = new ItemModel();
        $getItem = $itemModel
        ->where('umkm', $_SESSION['umkm'])
        ->findAll();

        return view('/member/dashboard-item', [
            'getItem' => $getItem
        ]);
    }

    public function item_create_post_member(){
        $validationRules = [
            'category' => 'required',
            'name_item' => 'required',
            'img' => 'uploaded[img]|mime_in[img,image/png,image/jpeg,image/jpg]',
            'stock' => 'required|numeric',
            'price' => 'required',
            'description' => 'required'
        ];
    
        $validationMessages = [
            'category' => [
                'required' => 'Category field is required'
            ],
            'name_item' => [
                'required' => 'Name item field is required'
            ],
            'img' => [
                'uploaded' => 'Image field is required',
                'mime_in' => 'The image must be a PNG or JPEG or JPG'
            ],
            'stock' => [
                'required' => 'Stock field is required',
                'numeric' => 'Stock field must be a number'
            ],
            'price' => [
                'required' => 'Price field is required',
            ],
            'description' => [
                'required' => 'Description field is required'
            ]
        ];
    
        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $category = $this->request->getVar('category');
        $name_item = $this->request->getVar('name_item');
        $img = $this->request->getFile('img');
        $stock = $this->request->getVar('stock');
        $price = $this->request->getVar('price');
        $description = $this->request->getVar('description');
    
        // Check if the file was uploaded successfully
        if ($img->getError() == UPLOAD_ERR_OK) {
            // Get the file name and extension
            $imageName = $img->getName();
            $imageExt = $img->getClientExtension();
    
            // Generate a unique name for the file
            $newName = uniqid('', true) . '.' . $imageExt;
    
            // Move the file to the public/images directory
            $img->move('images', $newName);
    
            // Store the path in the database
            $imgPath = base_url('images/' . $newName);
        } else {
            $imgPath = '';
        }
    
        $itemModel = new ItemModel();
        $InsertResult = $itemModel->createItem([
            'umkm' => $_SESSION['umkm'],
            'category' => $category,
            'name_item' => $name_item,
            'img' => $imgPath,
            'stock' => $stock,
            'price' => $price,
            'description' => $description,
        ]);
    
        if (!empty($InsertResult['uuid'])) {
            return redirect()->to('/member/dashboard//item')->with('success', 'success adding item');
        } else {
            return redirect()->to('/member/dashboard/item')->with('errors', 'failed add item');
        }
    }

    public function item_edit_post_member($item_uuid){
        $itemModel = new ItemModel();
        $getItem = $itemModel
            ->where('uuid', $item_uuid)
            ->first();
        if(!empty($getItem)){
            $validationRules = [
                'category' => 'required',
                'name_item' => 'required',
                'img' => 'uploaded[img]|mime_in[img,image/png,image/jpeg,image/jpg]',
                'stock' => 'required|numeric',
                'price' => 'required',
                'description' => 'required'
            ];
        
            $validationMessages = [
                'category' => [
                    'required' => 'Category field is required in edit form'
                ],
                'name_item' => [
                    'required' => 'Name item field is required in edit form'
                ],
                'img' => [
                    'uploaded' => 'Image field is required in edit form',
                    'mime_in' => 'The image must be a PNG or JPEG or JPG in edit form'
                ],
                'stock' => [
                    'required' => 'Stock field is required in edit form',
                    'numeric' => 'Stock field must be a number in edit form'
                ],
                'price' => [
                    'required' => 'Price field is required in edit form',
                ],
                'description' => [
                    'required' => 'Description field is required in edit form'
                ]
            ];
        
            if (!$this->validate($validationRules, $validationMessages)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            $img = $this->request->getFile('img');
            if ($img->getError() == UPLOAD_ERR_OK) {
                // Get the file name and extension
                $imageName = $img->getName();
                $imageExt = $img->getClientExtension();
        
                // Generate a unique name for the file
                $newName = uniqid('', true) . '.' . $imageExt;
        
                // Move the file to the public/images directory
                $img->move('images', $newName);
        
                // Store the path in the database
                $imgPath = base_url('images/' . $newName);
            } else {
                $imgPath = '';
            }
            $itemModel->where('uuid', $item_uuid)->set([
                'category' => $this->request->getVar('category'),
                'name_item' => $this->request->getVar('name_item'),
                'img' => $imgPath,
                'stock' => $this->request->getVar('stock'),
                'price' => $this->request->getVar('price'),
                'description' => $this->request->getVar('description'),
            ])->update();
            return redirect()->to('/member/dashboard/item')->with('success', 'success updating item');
        }
        else return redirect()->to('/member/dashboard/item')->with('error', 'failed when updating item');
    }

    public function item_delete_member($item_uuid){
        $itemModel = new ItemModel();
        $getItem = $itemModel->where('uuid', $item_uuid)->first();
        if(!empty($getItem)){
            $itemModel->where('uuid', $item_uuid)->delete();
            return redirect()->to('/member/dashboard/item')->with('success', 'success deleting item');
        }
        else return redirect()->to('/member/dashboard/item')->with('error', 'error when deleting item');
    }
}
