//
//  AddFriendTableViewController.swift
//  pet-tracker
//
//  Created by Matthew Baker on 2/10/20.
//  Copyright © 2020 Matthew Baker. All rights reserved.
//

import UIKit

class AddFriendTableViewController: UITableViewController, UIPickerViewDelegate, UIPickerViewDataSource {
    
    var eyeColorPickerData:[String] = []
    
    let eyeColorPickerIndexPath = IndexPath(row: 1, section: 3)
    let eyeColorLabelIndexPath = IndexPath(row: 0, section: 3)
    
    var isEyeColorPickerShown:Bool = false {
        didSet {
            eyeColorPicker.isHidden = !isEyeColorPickerShown
        }
    }
    
    @IBOutlet weak var firstNameText: UITextField!
    @IBOutlet weak var lastNameText: UITextField!
    @IBOutlet weak var emailText: UITextField!
    @IBOutlet weak var ageText: UITextField!
    @IBOutlet weak var eyeColorLabel: UILabel!
    @IBOutlet weak var eyeColorPicker: UIPickerView!
    
    override func viewDidLoad() {
        super.viewDidLoad()

        self.eyeColorPicker.dataSource = self
        self.eyeColorPicker.delegate = self
        
        eyeColorPickerData = ["Blue", "Green", "Brown"]
    }
    
    func numberOfComponents(in pickerView: UIPickerView) -> Int {
        return 1
    }
    
    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        eyeColorPickerData.count
    }
    
    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int, forComponent component: Int) -> String? {
        return eyeColorPickerData[row]
    }
    
    func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        eyeColorLabel.text = eyeColorPickerData[eyeColorPicker.selectedRow(inComponent: 0)]
    }
    
    @IBAction func addFriend(_ sender: Any) {
        if firstNameText.text == "" || lastNameText.text == "" || ageText.text == "" || emailText.text == "" {
            let alertController = UIAlertController(title: "Error", message:"Fill out all of the text fields!", preferredStyle: .alert)
            
            alertController.addAction(UIAlertAction(title: "Dismiss", style: .default))
            
            self.present(alertController, animated: true, completion: nil)
        } else {
            guard let age = Int16(ageText.text!) else {
                let alertController = UIAlertController(title: "Error", message:"Invalid entry for age!", preferredStyle: .alert)
                
                alertController.addAction(UIAlertAction(title: "Dismiss", style: .default))

                self.present(alertController, animated: true, completion: nil)
                
                return
            }
            
            guard let appDelegate = UIApplication.shared.delegate as? AppDelegate else {
                fatalError("Unable to access App Delegate")
            }
            
            let context = appDelegate.persistentContainer.viewContext
            
            let friend = Friend(entity: Friend.entity(), insertInto: context)
            
            friend.firstName = firstNameText.text
            friend.lastName = lastNameText.text
            friend.age = age
            friend.email = emailText.text
            friend.eyeColor = eyeColorPickerData[eyeColorPicker.selectedRow(inComponent: 0)]
            
            appDelegate.saveContext()
            
//            FriendsViewController.friends = FriendsViewController.retrieveFriends()
            
            performSegue(withIdentifier: "addNewFriendSegue", sender: nil)
        }
    }
    
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        switch indexPath {
        case eyeColorPickerIndexPath:
            if isEyeColorPickerShown {
                return 216.0
            } else {
                return 0.0
            }
        default:
            return 44.0
        }
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        
        if indexPath == eyeColorLabelIndexPath {
            if isEyeColorPickerShown {
                isEyeColorPickerShown = false
            } else {
                isEyeColorPickerShown = true
            }
            tableView.beginUpdates()
            tableView.endUpdates()
        }
    }

    // MARK: - Table view data source

//    override func numberOfSections(in tableView: UITableView) -> Int {
//        // #warning Incomplete implementation, return the number of sections
//        return 0
//    }
//
//    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
//        // #warning Incomplete implementation, return the number of rows
//        return 0
//    }

    /*
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "reuseIdentifier", for: indexPath)

        // Configure the cell...

        return cell
    }
    */

    /*
    // Override to support conditional editing of the table view.
    override func tableView(_ tableView: UITableView, canEditRowAt indexPath: IndexPath) -> Bool {
        // Return false if you do not want the specified item to be editable.
        return true
    }
    */

    /*
    // Override to support editing the table view.
    override func tableView(_ tableView: UITableView, commit editingStyle: UITableViewCell.EditingStyle, forRowAt indexPath: IndexPath) {
        if editingStyle == .delete {
            // Delete the row from the data source
            tableView.deleteRows(at: [indexPath], with: .fade)
        } else if editingStyle == .insert {
            // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view
        }    
    }
    */

    /*
    // Override to support rearranging the table view.
    override func tableView(_ tableView: UITableView, moveRowAt fromIndexPath: IndexPath, to: IndexPath) {

    }
    */

    /*
    // Override to support conditional rearranging of the table view.
    override func tableView(_ tableView: UITableView, canMoveRowAt indexPath: IndexPath) -> Bool {
        // Return false if you do not want the item to be re-orderable.
        return true
    }
    */

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
    }
    */

}
