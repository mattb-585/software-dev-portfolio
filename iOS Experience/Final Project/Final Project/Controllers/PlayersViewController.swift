//
//  PlayersViewController.swift
//  Final Project
//
//  Created by Matthew Baker on 11/6/19.
//  Copyright © 2019 Matthew Baker. All rights reserved.
//

import UIKit

class PlayersViewController: UITableViewController {

    @IBOutlet weak var playersTextField: UITextField!
    
    var maxPlayers:[Int] = []
    
    var players:String = ""
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        playersTextField.text = ""
        
        for number in 2...50 {
            maxPlayers.append(number)
        }

        // Do any additional setup after loading the view.
    }
    
    @IBAction func unwindToPlayer(_ sender: UIStoryboardSegue) {}
    
    @IBAction func playersSaveButtonClicked(_ sender: Any) {
        players = playersTextField.text!
        if let players = Int(players) {
            if players >= 2 && players <= 50 {
                performSegue(withIdentifier: "toServerSegue", sender: nil)
            }
            else
            {
                let alert = UIAlertController(title: "Invalid Entry", message: "Must be a number between 2 and 50", preferredStyle: .alert)
                alert.addAction(UIAlertAction(title: "OK", style: .default, handler: nil))
                self.present(alert, animated: true)
                playersTextField.text = ""
            }
        }
        else
        {
            let alert = UIAlertController(title: "Numbers Only!", message: "", preferredStyle: .alert)
            alert.addAction(UIAlertAction(title: "OK", style: .default, handler: nil))
            self.present(alert, animated: true)
            playersTextField.text = ""
        }
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if segue.identifier == "toServerSegue" {
            let serverViewController = segue.destination as! ServerViewController
            let numofPlayers = Int(players)
            
            serverViewController.numberofPlayers = numofPlayers
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
