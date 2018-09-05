<?php 
$config = array(
        
        'manager' => array(
                array(
                        'field' => 'fullName',
                        'label' => 'full name',
                        'rules' => 'trim|required'
                ),
              array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|required|valid_email|is_unique[users.email]',
                        'errors' => array('is_unique' => 'The %s is already registered.')
                ),
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'contact',
                        'label' => 'Contact number',
                        'rules' => 'trim|required'
                )
                
        ),'manageredit' => array(
                array(
                        'field' => 'fullName',
                        'label' => 'full name',
                        'rules' => 'trim|required'
                ),
              array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|required|valid_email',
                        'errors' => array('is_unique' => 'The %s is already registered.')
                ),
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'contact',
                        'label' => 'Contact number',
                        'rules' => 'trim|required'
                )
                
        ),
        'productEdit' => array(
                array(
                        'field' => 'name',
                        'label' => 'product name',
                        'rules' => 'trim|required'
                         
                ),
               array(
                        'field' => 'unitTypeId',
                        'label' => 'unit type',
                        'rules' => 'trim|required'
                ),
               array(
                        'field' => 'categoryId',
                        'label' => 'product category',
                        'rules' => 'trim|required'
                ),
               array(
                        'field' => 'yd3weight',
                        'label' => 'yd3 weight',
                        'rules' => 'trim|required'
                ),
               array(
                        'field' => 'specification',
                        'label' => 'specification',
                        'rules' => 'trim|required'
                ),
               array(
                        'field' => 'application',
                        'label' => 'application detail ',
                        'rules' => 'trim|required'
                )
               
                
        ),
        'product' => array(
                array(
                        'field' => 'name',
                        'label' => 'product name',
                        'rules' => 'trim|required|is_unique[product.name]',
                         'errors' => array('is_unique' => 'The %s is already exists.')
                ),
               array(
                        'field' => 'unitTypeId',
                        'label' => 'unit type',
                        'rules' => 'trim|required'
                ),
               array(
                        'field' => 'categoryId',
                        'label' => 'product category',
                        'rules' => 'trim|required'
                ),
               array(
                        'field' => 'yd3weight',
                        'label' => 'yd3 weight',
                        'rules' => 'trim|required'
                ),
               array(
                        'field' => 'specification',
                        'label' => 'specification',
                        'rules' => 'trim|required'
                ),
               array(
                        'field' => 'application',
                        'label' => 'application detail',
                        'rules' => 'trim|required'
                )
               
                
        ),
        
         'pits' => array(
                array(
                        'field' => 'miles',
                        'label' => 'Delivery miles',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'latitude',
                        'label' => 'latitude',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'longitude',
                        'label' => 'longitude',
                        'rules' => 'trim|required'
                ),
                 array(
                        'field' => 'emailAddress',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|is_unique[pits.email]',
                         'errors' => array('is_unique' => '%s is already exists.')
                ), 
               
        ),
         'pitsEdit' => array(
                array(
                        'field' => 'miles',
                        'label' => 'Delivery miles',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'latitude',
                        'label' => 'latitude',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'longitude',
                        'label' => 'longitude',
                        'rules' => 'trim|required'
                ),
                 array(
                        'field' => 'emailAddress',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email'
                ), 
               
        ),

         'offices' => array(
                array(
                        'field' => 'locationName',
                        'label' => 'Location name',
                        'rules' => 'trim|required'
                ),         
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required'
                ),         
                array(
                        'field' => 'contactName',
                        'label' => 'Contact Name',
                        'rules' => 'trim|required'
                ),         
                array(
                        'field' => 'phoneNumber',
                        'label' => 'Phone Number',
                        'rules' => 'trim|required'
                ),         
                array(
                        'field' => 'saleTax',
                        'label' => 'Sale Tax',
                        'rules' => 'trim|required'
                ), 
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email'
                ),        
                array(
                        'field' => 'manager',
                        'label' => 'Manager',
                        'rules' => 'trim|required'
                ),        
        ),

         'truck' => array(
                array(
                        'field' => 'truckNumber',
                        'label' => 'Truck Number',
                        'rules' => 'trim|required'
                ),array(
                        'field' => 'truckModel',
                        'label' => 'Truck Model',
                        'rules' => 'trim|required'
                ) ,array(
                        'field' => 'truckClass',
                       'label' => 'Truck Class',
                        'rules' => 'trim|required'
                ) ,array(
                        'field' => 'maxTone',
                       'label' => 'Max Tonnage Load',
                        'rules' => 'trim|required'
                ) ,array(
                        'field' => 'maxBed',
                        'label' => 'Max YD3 Bed',
                        'rules' => 'trim|required'
                ) ,array(
                        'field' => 'agent',
                       'label' => 'Agent Name',
                        'rules' => 'trim|required'
                ) ,array(
                        'field' => 'agentPhone',
                       'label' => 'Agent Phone Number',
                        'rules' => 'trim|required'
                ) ,array(
                        'field' => 'insuranceCompany',
                       'label' => 'Insurance Company',
                        'rules' => 'trim|required'
                ) ,array(
                        'field' => 'insurancePolicyNo',
                       'label' => 'Policy Number',
                        'rules' => 'trim|required'
                ) ,array(
                        'field' => 'expireInfo',
                        'label' => 'Insurance Expiration Date',
                        'rules' => 'trim|required'
                )   ,array(
                        'field' => 'tagPlate',
                       'label' => 'Tag Plate',
                        'rules' => 'trim|required'
                )        
        ),

        'driver' => array(
                array(
                        'field' => 'fullName',
                        'label' => 'Name',
                        'rules' => 'trim|required'
                ),
              array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email|is_unique[users.email]',
                        'errors' => array('is_unique' => 'The %s is already registered.')
                ),
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'contact',
                        'label' => 'Contact number',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'drivers_license',
                        'label' => 'Driver License',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'licence_expiry_date',
                        'label' => 'License Expiry Date',
                        'rules' => 'trim|required'
                )
                
        ),'driveredit' => array(
                array(
                        'field' => 'fullName',
                        'label' => 'full name',
                        'rules' => 'trim|required'
                ),
              array(
                        'field' => 'email',
                        'label' => 'email',
                        'rules' => 'trim|required|valid_email',
                        'errors' => array('is_unique' => 'The %s is already registered.')
                ),
                array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|required'
                ),
                array(
                        'field' => 'contact',
                        'label' => 'Contact number',
                        'rules' => 'trim|required'
                )
                
        )
         
);


?>
