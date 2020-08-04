//
//  ServerViewController.swift
//  Final Project
//
//  Created by Matthew Baker on 11/6/19.
//  Copyright © 2019 Matthew Baker. All rights reserved.
//

import UIKit

class ServerViewController: UITableViewController {

    @IBOutlet weak var serverTextField: UITextField!
    @IBOutlet weak var enterNumberServerLabel: UILabel!
    
    var startingNumberSetting:Int = 0
    var endingNumberSetting:Int = 0
    var numberofPlayers:Int?
    var serversNumber:String = ""
    
    var maxNumbers:[Int] = []
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if let savedSettings = Setting.loadFromFile() {
            startingNumberSetting = savedSettings.startingNumber
            endingNumberSetting = savedSettings.endingNumber
        } else {
            startingNumberSetting = 1
            endingNumberSetting = 1000
        }
        
        for number in startingNumberSetting...endingNumberSetting {
            maxNumbers.append(number)
        }
        
        enterNumberServerLabel.text = "Enter a number between \(startingNumberSetting) and \(endingNumberSetting)"

    }
    
    @IBAction func serverSaveButtonPressed(_ sender: Any) {
        serversNumber = serverTextField.text!
        if let server = Int(serversNumber) {
            if server >= startingNumberSetting && server <= endingNumberSetting {
                performSegue(withIdentifier: "toGuessSeuge", sender: nil)
            }
            else
            {
                let alert = UIAlertController(title: "Invalid Entry", message: "Must pick a number between \(startingNumberSetting) and \(endingNumberSetting)", preferredStyle: .alert)
                alert.addAction(UIAlertAction(title: "OK", style: .default, handler: nil))
                self.present(alert, animated: true)
                serverTextField.text = ""
            }
        }
        else
        {
            let alert = UIAlertController(title: "Numbers Only!", message: "", preferredStyle: .alert)
            alert.addAction(UIAlertAction(title: "OK", style: .default, handler: nil))
            self.present(alert, animated: true)
            serverTextField.text = ""
        }
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if segue.identifier == "toGuessSeuge" {
            let guessViewController = segue.destination as! GuessViewController
            let numberofPlayers = self.numberofPlayers
            let serversNumber = Int(self.serversNumber)
            
            guessViewController.numberofPlayers = numberofPlayers
            guessViewController.serversNumber = serversNumber
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
