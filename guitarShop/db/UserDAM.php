
<?php

/**
 * Product model data access and manipulation (DAM) class.
 *
 * @author Lance and jam
 */
class ProductDAM extends DAM {

    // Database connection is inherited from the parent.
    function __construct() {
        parent::__construct();
    }

    /**
     * Read the User object from the database with the specified email
     * @param type $email the email of the user to be retreived.
     * @return \User the resulting User object - null if user is
     * not in the database.
     */
    public function getUser($email) {
        $query = 'SELECT * FROM users
              WHERE email = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $userDB = $statement->fetch();
        $statement->closeCursor();
        if ($userDB == null) {
            return null;
        } else {
            return new Product($this->mapColsToVars($userDB));
        }
    }
     

    /**
     * Read all the Product objects in the database.
     * @return \Product an array of Product objects.
     
    public function readProducts() {
        $query = 'SELECT * FROM products
              ORDER BY productID';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $productsDB = $statement->fetchAll();
        $statement->closeCursor();

        // Build an array of Product objects
        $products = array();
        foreach ($productsDB as $key => $value) {
            $products [$key] = new Product($this->mapColsToVars($productsDB[$key]));
        }
        return $products;
    }*/

    /**
     * Read all the Product objects in the database with the specified
     * categoryID.
     * @param type $categoryID the ID of the product category to be read.
     * @return \Product an array of Product objects.
     
    public function readProductsByCategoryId($categoryID) {
        $query = 'SELECT * FROM products
              WHERE categoryID = \''. $categoryID . '\'
              ORDER BY productID';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $productsDB = $statement->fetchAll();
        $statement->closeCursor();

        // Build an array of Product objects
        $products = array();
        foreach ($productsDB as $key => $value) {
            $products [$key] = new Product($this->mapColsToVars($productsDB[$key]));
        }
        return $products;
    }*/

    /**
     * Write the specified product to the database. If the product is not
     * in the database, the object is added. If the product is already in the
     * database, the object is updated.
     * @param type $product the Product object to be written.
     */
    public function createUser($user) {

        // Check to see if the product is already in the database.
        $query = 'SELECT email FROM users
              WHERE email = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $user->email)
        $statement->execute();
        $userDB = $statement->fetch();
        $statement->closeCursor();
        if ($user == null) {

            // Add a new user to the database
            $query = 'INSERT INTO products
                (firstname, lastname, email, 
                phone, address, city, zip, country, 
                state, password, admin)
              VALUES
                (:firstname, :lastname, :email, 
                :phone, :address, :city, :zip, 
                :country, :state, :password, :admin )';
            $statement = $this->db->prepare($query);
            $statement->bindValue(':firstname',$user->firstname);
            $statement->bindValue(':lastname',$user->lastname);
            $statement->bindValue(':email',$user->email);
            $statement->bindValue(':phone',$user->phone);
            $statement->bindValue(':address',$user->address);
            $statement->bindValue(':city',$user->city);                      
            $statement->bindValue(':zip',$user->zip);                      
            $statement->bindValue(':country',$user->country);                     
            $statement->bindValue(':state',$user->state);
            $statement->bindValue(':password',$user->password);
            $statement->bindValue(':admin',$user->admin);
            $statement->execute();
            $statement->closeCursor();
        } else {
            //nothing
        }
    }

    // This function should only be used by logged in users on their own user email. 
    // This should not be used to create a new user.
    // This function can not be used to update non-existant users.
    public function updateUser($user) {

        // Check to see if the product is already in the database.
        $query = 'SELECT email FROM users
              WHERE email = :email';
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $user->email)
        $statement->execute();
        $userDB = $statement->fetch();
        $statement->closeCursor();
        if ($user == null) {
            //nothing
        } else {

            // Update an existing user.
            $query = 'UPDATE users
              SET firstname = :firstname, lastname = :lastname, 
                email = :email, phone = :phone, address = :address, 
                city = :city, zip = :zip, country = :country, 
                state = :state, password = :password, admin = :admin
              WHERE id = :id';

            $statement = $this->db->prepare($query);
            $statement->bindValue(':id',$user->id);
            $statement->bindValue(':firstname',$user->firstname);
            $statement->bindValue(':lastname',$user->lastname);
            $statement->bindValue(':email',$user->email);
            $statement->bindValue(':phone',$user->phone);
            $statement->bindValue(':address',$user->address);
            $statement->bindValue(':city',$user->city);                      
            $statement->bindValue(':zip',$user->zip);                      
            $statement->bindValue(':country',$user->country);                     
            $statement->bindValue(':state',$user->state);
            $statement->bindValue(':password',$user->password);
            $statement->bindValue(':admin',$user->admin);
            $statement->execute();
            $statement->closeCursor();
        }
    }
    /**
     * Delete the specified Product object from the database.
     * 
     * @param type $product the Product object to be deleted.
     
    public function deleteProduct($product) {
        $this->deleteProductById($product->id);
    }

    /**
     * Delete the Product object from the database with the specified ID.
     * 
     * @param type $productID the ID of the Product to be deleted.
     
    public function deleteProductById($productID) {
        $query = 'DELETE FROM products WHERE productID = \'' . $productID . '\'';
        $statement = $this->db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }*/

    // Translate database columnames to object instance variable names
    private function mapColsToVars($colArray) {
        $varArray = array();
        foreach ($colArray as $key => $value) {
            if ($key == 'id') {
                $varArray ['id'] = $value;
            } else if ($key == 'firstname') {
                $varArray ['firstname'] = $value;
            } else if ($key == 'lastname') {
                $varArray ['lastname'] = $value;
            } else if ($key == 'phone') {
                $varArray ['phone'] = $value;
            } else if ($key == 'address') {
                $varArray ['address'] = $value;
            } else if ($key == 'city') {
                $varArray ['city'] = $value;
            } else if ($key == 'zip') {
                $varArray ['zip'] = $value;
            } else if ($key == 'country') {
                $varArray ['country'] = $value;
            } else if ($key == 'state') {
                $varArray ['state'] = $value;
            } else if ($key == 'password') {
                $varArray ['password'] = $value;
            } else if ($key == 'admin') {
                $varArray ['admin'] = $value;
            }
        }
        return $varArray;
    }
}
