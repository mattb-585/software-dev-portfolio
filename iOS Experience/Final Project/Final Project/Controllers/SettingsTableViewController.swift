//
//  SettingsTableViewController.swift
//  Final Project
//
//  Created by Matthew Baker on 11/27/19.
//  Copyright © 2019 Matthew Baker. All rights reserved.
//

import UIKit

class SettingsTableViewController: UITableViewController, UIPickerViewDataSource, UIPickerViewDelegate {
    
    var numbers:[Int] = []
    var numberItem = 1
    var startingNumberSelected:Int?
    var endingNumberSelected:Int?
    
    let startingNumberLabelCellIndexPath = IndexPath(row: 0, section: 0)
    let startingNumberPickerCellIndexPath = IndexPath(row: 1, section: 0)
    let endingNumberLabelCellIndexPath = IndexPath(row: 2, section: 0)
    let endingNumberPickerCellIndexPath = IndexPath(row: 3, section: 0)
    
    @IBOutlet weak var startingPickerView: UIPickerView!
    @IBOutlet weak var endingPickerView: UIPickerView!
    @IBOutlet weak var startingLabel: UILabel!
    @IBOutlet weak var endingLabel: UILabel!

    var isStarterNumberPickerShown: Bool = false {
        didSet {
            startingPickerView.isHidden = !isStarterNumberPickerShown
        }
    }
    
    var isEndingNumberPickerShown: Bool = false {
        didSet {
            endingPickerView.isHidden = !isEndingNumberPickerShown
        }
    }

    func numberOfComponents(in pickerView: UIPickerView) -> Int {
        return 1
    }

    func pickerView(_ pickerView: UIPickerView, titleForRow row: Int, forComponent component: Int) -> String? {
        return String(numbers[row])
    }

    func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        numbers.count
    }
    
    func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        updateSelection()
        updateSettings()
    }
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        while numberItem < 1001 {
            numbers.append(numberItem)
            numberItem += 1
        }
        
        if let savedSettings = Setting.loadFromFile() {
            startingNumberSelected = savedSettings.startingNumber
            endingNumberSelected = savedSettings.endingNumber
        } else {
            startingNumberSelected = 1
            endingNumberSelected = 1000
        }
        
        startingLabel.text = String(startingNumberSelected!)
        endingLabel.text = String(endingNumberSelected!)
        startingPickerView.selectRow(startingNumberSelected! - 1, inComponent: 0, animated: false)
        endingPickerView.selectRow(endingNumberSelected! - 1, inComponent: 0, animated: false)

        // Uncomment the following line to preserve selection between presentations
        // self.clearsSelectionOnViewWillAppear = false

        // Uncomment the following line to display an Edit button in the navigation bar for this view controller.
        // self.navigationItem.rightBarButtonItem = self.editButtonItem
    }
    
    func updateSelection(){
        if isStarterNumberPickerShown {
            startingNumberSelected = numbers[startingPickerView.selectedRow(inComponent: 0)]
            startingLabel.text = String(startingNumberSelected!)
        } else if isEndingNumberPickerShown {
            endingNumberSelected = numbers[endingPickerView.selectedRow(inComponent: 0)]
            endingLabel.text = String(endingNumberSelected!)
        }
    }
    
    func updateSettings() {
        let newSettings = Setting(startingNumber: startingNumberSelected!, endingNumber: endingNumberSelected!)
        Setting.saveToFile(setting: newSettings)
    }
 
    override func tableView(_ tableView: UITableView, heightForRowAt
    indexPath: IndexPath) -> CGFloat {
        switch indexPath {
        case startingNumberPickerCellIndexPath:
            if isStarterNumberPickerShown {
                return 216.0
            } else {
                return 0.0
            }
        case endingNumberPickerCellIndexPath:
            if isEndingNumberPickerShown {
                return 216.0
            } else {
                return 0.0
            }
        default:
            return 44.0
        }
    }

    override func tableView(_ tableView: UITableView, didSelectRowAt
    indexPath: IndexPath) {
        tableView.deselectRow(at: indexPath, animated: true)

        switch indexPath {
        case startingNumberLabelCellIndexPath:

            if isStarterNumberPickerShown {
                isStarterNumberPickerShown = false
            } else if isEndingNumberPickerShown {
                isEndingNumberPickerShown = false
                isStarterNumberPickerShown = true
            } else {
                isStarterNumberPickerShown = true
            }

            tableView.beginUpdates()
            tableView.endUpdates()

        case endingNumberLabelCellIndexPath:
            if isEndingNumberPickerShown {
                isEndingNumberPickerShown = false
            } else if isStarterNumberPickerShown {
                isStarterNumberPickerShown = false
                isEndingNumberPickerShown = true
            } else {
                isEndingNumberPickerShown = true
            }

            tableView.beginUpdates()
            tableView.endUpdates()

        default:
            break
        }
    }
}
