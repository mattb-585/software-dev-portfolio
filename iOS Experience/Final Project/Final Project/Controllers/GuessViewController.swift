//
//  GuessViewController.swift
//  Final Project
//
//  Created by Matthew Baker on 11/6/19.
//  Copyright © 2019 Matthew Baker. All rights reserved.
//

import UIKit
import CoreData

class GuessViewController: UIViewController, UITableViewDelegate, UITableViewDataSource {
    
    var guesses:[String]?
    
    @IBOutlet weak var tableView: UITableView!
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return guesses!.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "guessId", for: indexPath)

        cell.textLabel?.text = "\(guesses![indexPath.row])"

        return cell
    }

    
    var startingNumberSetting:Int?
    var endingNumberSetting:Int?
    var numberofPlayers:Int?
    var serversNumber:Int?
    var playerCounter = 0
    
    @IBOutlet weak var enterNumberGuessLabel: UILabel!
    @IBOutlet weak var guessNumberTextField: UITextField!
    @IBOutlet weak var currentPlayerLabel: UILabel!
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        self.tableView.delegate = self
        self.tableView.dataSource = self

        if let savedSettings = Setting.loadFromFile() {
            startingNumberSetting = savedSettings.startingNumber
            endingNumberSetting = savedSettings.endingNumber
        } else {
            startingNumberSetting = 1
            endingNumberSetting = 1000
        }
        
        enterNumberGuessLabel.text = "Enter a number between \(startingNumberSetting!) and \(endingNumberSetting!)"
        
        playerCounter = 1
        
        guesses = []
        
        tableView.tableFooterView = UIView()
    }
    
    @IBAction func guessButtonTapped(_ sender: Any) {
        guard let numberGuessed = Int(guessNumberTextField.text!) else {
            let alert = UIAlertController(title: "Invalid Entry", message: "Must enter a number!", preferredStyle: .alert)
            alert.addAction(UIAlertAction(title: "OK", style: .default, handler: nil))
            self.present(alert, animated: true)
            guessNumberTextField.text! = ""
            return
        }
        
        if numberGuessed < startingNumberSetting! || numberGuessed > endingNumberSetting! {
            let alert = UIAlertController(title: "Invalid Entry", message: "Must pick a number between \(startingNumberSetting!) and \(endingNumberSetting!)", preferredStyle: .alert)
            alert.addAction(UIAlertAction(title: "OK", style: .default, handler: nil))
            self.present(alert, animated: true)
            guessNumberTextField.text! = ""
            return
        }
        
        if numberGuessed > serversNumber! {
            guesses?.append("Player \(playerCounter) guessed \(numberGuessed) - GO LOWER!")
            updateGuessScene()
        } else if numberGuessed < serversNumber! {
            guesses?.append("Player \(playerCounter) guessed \(numberGuessed) - GO HIGHER!")
            updateGuessScene()
        } else {
            guesses?.append("Player \(playerCounter) guessed \(numberGuessed) - YOU WIN!")
            guessNumberTextField.text! = ""
            
            guard let appDelegate = UIApplication.shared.delegate as? AppDelegate else {
                fatalError("Unable to access App Delegate")
            }
            
            let context = appDelegate.persistentContainer.viewContext
            
            let game = History(entity: History.entity(), insertInto: context)
            
            let historyFetchRequest = NSFetchRequest<History>(entityName: "History")
            
            var historyCount = 0
            
            do {
                historyCount = try context.count(for: historyFetchRequest)
            } catch let err as NSError {
                fatalError("Unable to fetch People \(err.description)")
            }
            
            game.gameName = "Game \(historyCount)"
            game.playerAmount = Int16(self.numberofPlayers!)
            game.winningNumber = Int16(self.serversNumber!)
            game.date = Date()
            game.guesses = guesses!.joined(separator:", ")
            game.winner = Int16(self.playerCounter)
            
            appDelegate.saveContext()
            
            performSegue(withIdentifier: "toWinnerSegue", sender: nil)
        }
    }
    
    func updateGuessScene() {
        tableView.reloadData()
        playerCounter += 1
        if playerCounter > numberofPlayers! {
            playerCounter = 1
        }
        currentPlayerLabel.text = "Player \(playerCounter)"
        guessNumberTextField.text! = ""
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if segue.identifier == "toWinnerSegue" {
            let navController = segue.destination as! UINavigationController
            let winnnerViewController = navController.topViewController as!
            WinnerViewController
            let winningPlayer = playerCounter
            winnnerViewController.winningPlayer = winningPlayer
            
//            HistoryManager.historyData.addGame(gameName: "Game \(HistoryManager.historyData.pastGames.count + 1)", playerAmount: numberofPlayers!, winningNumber: serversNumber!, guesses: guesses!, winner: winningPlayer)
            
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
