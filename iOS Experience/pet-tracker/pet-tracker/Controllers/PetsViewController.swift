//
//  PetsViewController.swift
//  pet-tracker
//
//  Created by Matthew Baker on 2/11/20.
//  Copyright © 2020 Matthew Baker. All rights reserved.
//

import UIKit

class PetsViewController: UIViewController, UICollectionViewDataSource {
    
    @IBOutlet weak var petCollectionView: UICollectionView!
    
    var appDelegate:AppDelegate!
    
    var delegate:UICollectionViewDelegateFlowLayout?
    
    var friend:Friend?
    var pets:[Pet] = []
    
    @IBOutlet weak var searchTextField: UITextField!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        appDelegate = (UIApplication.shared.delegate as! AppDelegate)
        
        initializeDelegate()
        
        petCollectionView.dataSource = self
        petCollectionView.delegate = delegate
        
        pets = friend?.pets?.allObjects as! [Pet]
        
        let iconWidth = 20;
        let iconHeight = 20;
        
        let searchIconView = UIImageView();
        let icon = UIImage(named: "Search");
        searchIconView.image = icon;
        
        searchIconView.frame = CGRect(x: 5, y: 5, width: iconWidth, height: iconHeight)
        searchTextField.leftViewMode = UITextField.ViewMode.always
        searchTextField.addSubview(searchIconView)

        let padding = UIView(frame: CGRect(x: 0, y: 0, width: 25, height: self.searchTextField.frame.height))
        searchTextField.leftView = padding
        
    }
    
    func initializeDelegate() {
        delegate = FriendsCollectionViewDelegate(numberOfItemsPerRow: 2, interItemSpacing: 40, lineSpacing: 10, viewController: self)
    }
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return pets.count
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        guard let petCell = collectionView.dequeueReusableCell(withReuseIdentifier: PetCollectionViewCell.reuseIdentifier, for: indexPath) as? PetCollectionViewCell else {
            fatalError("Cannot load cell")
        }
        
        petCell.petImage.image = UIImage(named: "PetImage")
        petCell.petNameLabel.text = "\(pets[indexPath.item].name!)"
        petCell.speciesLabel.text = "\(pets[indexPath.item].species!)"
        petCell.dateOfBirthLabel.text = "\(pets[indexPath.item].dateOfBirth!)"
        
        return petCell
    }
    
    static func retrievePets() -> [Pet] {
        guard let appDelegate = UIApplication.shared.delegate as? AppDelegate else {
            fatalError("Unable to access App Delegate")
        }
            
        let context = appDelegate.persistentContainer.viewContext
            
        do {
            return try context.fetch(Pet.fetchRequest())
        } catch let err as NSError {
            fatalError("Unable to fetch Pets \(err.description)")
        }
    }
    
    @IBAction func unwindToPets(segue:UIStoryboardSegue) {
        pets = friend?.pets?.allObjects as! [Pet]
        petCollectionView.reloadData()
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
            
        if let navController = segue.destination as? UINavigationController {
            let addPetsViewController = navController.topViewController as? AddPetTableViewController
            addPetsViewController?.friend = self.friend
            addPetsViewController?.pets = self.pets
        } else {
            fatalError("Could not get controller")
        }
            
    }

}

