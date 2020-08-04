//
//  AddPetTableViewController.swift
//  pet-tracker
//
//  Created by Matthew Baker on 2/19/20.
//  Copyright © 2020 Matthew Baker. All rights reserved.
//

import UIKit

class AddPetTableViewController: UITableViewController, UIPickerViewDelegate, UIPickerViewDataSource {
    
    var pets:[Pet]?
    var newPet:Pet?
    var friend:Friend?
    
    var appDelegate:AppDelegate!
    
    var speciesPickerData:[String] = []
    
    let speciesPickerIndexPath = IndexPath(row: 1, section: 1)
    let speciesLabelIndexPath = IndexPath(row: 0, section: 1)
    let dateOfBirthPickerIndexPath = IndexPath(row: 1, section: 2)
    let dateOfBirthLabelIndexPath = IndexPath(row: 0, section: 2)
    
    var isSpeciesPickerShown:Bool = false {
        didSet {
            speciesPicker.isHidden = !isSpeciesPickerShown
        }
    }
    
    var isDateOfBirthPickerShown:Bool = false {
        didSet {
            dateOfBirthPicker.isHidden = !isDateOfBirthPickerShown
        }
    }
    
    @IBOutlet weak var petNameTextField: UITextField!
    @IBOutlet weak var speciesPickerLabel: UILabel!
    @IBOutlet weak var speciesPicker: UIPickerView!
    @IBOutlet weak var dateOfBirthPickerLabel: UILabel!
    @IBOutlet weak var dateOfBirthPicker: UIDatePicker!
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        appDelegate = (UIApplication.shared.delegate as! AppDelegate)

        self.speciesPicker.dataSource = self
        self.speciesPicker.delegate = self
        
        speciesPickerData = ["Dog", "Cat", "Horse"]
    }
    
    func numberOfComponents(in pickerView: UIPickerView) -> Int {
        return 1
    }
    
    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        speciesPickerData.count
    }
    
    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int, forComponent component: Int) -> String? {
        return speciesPickerData[row]
    }
    
    func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        speciesPickerLabel.text = speciesPickerData[speciesPicker.selectedRow(inComponent: 0)]
//        let formatter = DateFormatter()
//        formatter.dateFormat = "MM/dd/yyyy"
//        dateOfBirthPickerLabel.text = formatter.string(from: dateOfBirthPicker.date)
    }
    
    @IBAction func dateOfBirthChanged(_ sender: Any) {
        let formatter = DateFormatter()
        formatter.dateStyle = .medium
        dateOfBirthPickerLabel.text = formatter.string(from: dateOfBirthPicker.date)
    }
    
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        switch indexPath {
        case speciesPickerIndexPath:
            if isSpeciesPickerShown {
                return 216.0
            } else {
                return 0.0
            }
        case dateOfBirthPickerIndexPath:
            if isDateOfBirthPickerShown {
                return 216.0
            } else {
                return 0.0
            }
        default:
            return 44.0
        }
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        switch indexPath {
        case speciesLabelIndexPath:
            if isSpeciesPickerShown {
                isSpeciesPickerShown = false
            } else if isDateOfBirthPickerShown {
                isSpeciesPickerShown = true
                isDateOfBirthPickerShown = false
            } else {
                isSpeciesPickerShown = true
            }
            tableView.beginUpdates()
            tableView.endUpdates()
        case dateOfBirthLabelIndexPath:
            if isDateOfBirthPickerShown {
                isDateOfBirthPickerShown = false
            } else if isSpeciesPickerShown {
                isDateOfBirthPickerShown = true
                isSpeciesPickerShown = false
            } else {
                isDateOfBirthPickerShown = true
            }
            tableView.beginUpdates()
            tableView.endUpdates()
        default:
            break
        }
        
    }
    
    @IBAction func addPet(_ sender: Any) {
        
        if petNameTextField.text == "" {
            let alertController = UIAlertController(title: "Error", message: "Fill out pet's name!", preferredStyle: .alert)
            
            alertController.addAction(UIAlertAction(title: "OK", style: .default, handler: nil))
            
            self.present(alertController, animated: true, completion: nil)
        } else {
            
            let context = appDelegate.persistentContainer.viewContext
            
            let newPet = Pet(entity: Pet.entity(), insertInto: context)
            
            newPet.name = petNameTextField.text
            newPet.species = speciesPickerLabel.text
            newPet.dateOfBirth = dateOfBirthPickerLabel.text
            friend?.addToPets(newPet)
            appDelegate.saveContext()
            
            performSegue(withIdentifier: "addPetSegue", sender: nil)
        }
    }
    

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
    }
    */

}
