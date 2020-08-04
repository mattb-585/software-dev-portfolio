//
//  FriendsViewController.swift
//  pet-tracker
//
//  Created by Matthew Baker on 2/2/20.
//  Copyright © 2020 Matthew Baker. All rights reserved.
//

import UIKit
import CoreData

class FriendsViewController: UIViewController, UICollectionViewDataSource {
    
    static var friends:[Friend] = []
    static var selectedFriend:Friend?
    
//    var filteredFriends:[Friend] = []
    
    @IBOutlet weak var searchTextField: UITextField!
    
    func retrieveFriends() -> [Friend] {
        let friendFetchRequest = NSFetchRequest<Friend>(entityName: "Friend")
        
        guard let appDelegate = UIApplication.shared.delegate as? AppDelegate else {
            fatalError("Unable to access App Delegate")
        }
            
        let context = appDelegate.persistentContainer.viewContext
        
        if searchTextField.text != "" {
            friendFetchRequest.predicate = NSCompoundPredicate(
                type: .or,
                subpredicates: [
                    NSPredicate(format: "firstName = %@", "\(searchTextField.text!.capitalized)"),
                    NSPredicate(format: "lastName = %@", "\(searchTextField.text!.capitalized)")
                ]
            )
        }
            
        do {
            return try context.fetch(friendFetchRequest)
        } catch let err as NSError {
            fatalError("Unable to fetch People \(err.description)")
        }
    }
    
    var delegate:UICollectionViewDelegateFlowLayout?
    
    @IBOutlet weak var friendsCollectionView: UICollectionView!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        initializeDelegate()
        
//        friendsCollectionView.dataSource = self
        friendsCollectionView.delegate = delegate
        
        FriendsViewController.friends = retrieveFriends()
        
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
    
    @IBAction func unwindToFriends(segue:UIStoryboardSegue) {
        FriendsViewController.friends = retrieveFriends()
        friendsCollectionView.reloadData()
    }
    
    @IBAction func searchingFriends(_ sender: Any) {
        FriendsViewController.friends = retrieveFriends()
        friendsCollectionView.reloadData()
    }
    
    @IBAction func cancelSearch(_ sender: Any) {
        searchTextField.text = ""
        FriendsViewController.friends = retrieveFriends()
        friendsCollectionView.reloadData()
    }
    
    
    func initializeDelegate() {
        delegate = FriendsCollectionViewDelegate(numberOfItemsPerRow: 2, interItemSpacing: 40, lineSpacing: 10, viewController: self)
    }
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return FriendsViewController.friends.count
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        guard let friendCell = collectionView.dequeueReusableCell(withReuseIdentifier: FriendCollectionViewCell.reuseIdentifier, for: indexPath) as? FriendCollectionViewCell else {
            fatalError("Cannot load cell")
        }
        
        friendCell.friendImageView.image = UIImage(named: "ProfileImage")
        friendCell.friendNameLabel.text = "\(FriendsViewController.friends[indexPath.item].firstName!) \(FriendsViewController.friends[indexPath.item].lastName!)"
        friendCell.friendAddressLabel.text = FriendsViewController.friends[indexPath.item].email
        friendCell.friendAgeLabel.text = String(FriendsViewController.friends[indexPath.item].age)
        friendCell.friendEyeColorLabel.textColor = UIColor(named: FriendsViewController.friends[indexPath.item].eyeColor!)
        friendCell.friendEyeColorLabel.backgroundColor = UIColor(named: FriendsViewController.friends[indexPath.item].eyeColor!)
        
        return friendCell
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        
        if let petsViewController = segue.destination as? PetsViewController {
            petsViewController.friend = FriendsViewController.selectedFriend
        }
    }
}
