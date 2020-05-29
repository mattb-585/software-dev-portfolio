//
//  HistoryDetailViewController.swift
//  Final Project
//
//  Created by Matthew Baker on 12/5/19.
//  Copyright © 2019 Matthew Baker. All rights reserved.
//

import UIKit

class HistoryDetailViewController: UIViewController, UITableViewDelegate, UITableViewDataSource {
    
    var pastGame:History?
    var guesses:[String]?
    
    @IBOutlet weak var gameTitleLabel: UILabel!
    @IBOutlet weak var numofPlayersLabel: UILabel!
    @IBOutlet weak var winningPlayerLabel: UILabel!
    @IBOutlet weak var tableView: UITableView!
    @IBOutlet weak var winningNumberLabel: UILabel!
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return guesses!.count
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "pastGuessesId", for: indexPath)
        
        cell.textLabel?.text = "\(guesses![indexPath.row])"

        return cell
    }
    

    override func viewDidLoad() {
        super.viewDidLoad()
        
        guesses = pastGame?.guesses!.components(separatedBy: ", ")
        
        tableView.tableFooterView = UIView()

        gameTitleLabel.text = pastGame?.gameName
        numofPlayersLabel.text = "Number of Players: \(pastGame!.playerAmount)"
        winningPlayerLabel.text = "Winner: Player \(pastGame!.winner)"
        winningNumberLabel.text = "Winning Number: \(pastGame!.winningNumber)"
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
