//
//  HistoryTableViewController.swift
//  Final Project
//
//  Created by Matthew Baker on 12/3/19.
//  Copyright © 2019 Matthew Baker. All rights reserved.
//

import UIKit
import CoreData

class HistoryTableViewController: UITableViewController {
    
    var games:[History]?

    override func viewDidLoad() {
        super.viewDidLoad()

        games = retrieveGames()
        
        tableView.tableFooterView = UIView()
    }
    
    func retrieveGames() -> [History] {
        let historyFetchRequest = NSFetchRequest<History>(entityName: "History")
        
        guard let appDelegate = UIApplication.shared.delegate as? AppDelegate else {
            fatalError("Unable to access App Delegate")
        }
            
        let context = appDelegate.persistentContainer.viewContext
            
        do {
            return try context.fetch(historyFetchRequest)
        } catch let err as NSError {
            fatalError("Unable to fetch People \(err.description)")
        }
    }

    // MARK: - Table view data source

    override func numberOfSections(in tableView: UITableView) -> Int {
        // #warning Incomplete implementation, return the number of sections
        return 1
    }

    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        // #warning Incomplete implementation, return the number of rows
        return games!.count
    }

    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let cell = tableView.dequeueReusableCell(withIdentifier: "gameId", for: indexPath)

        let pastGame = games![indexPath.row]
        
        cell.textLabel?.text = pastGame.gameName
        
        let formatter = DateFormatter()
        formatter.dateFormat = "MM-dd-yyyy"
        cell.detailTextLabel?.text = formatter.string(from: pastGame.date!)

        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath)
    {
        
    }

    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        let detailViewController = segue.destination as? HistoryDetailViewController
        
        if let indexPath = tableView.indexPathForSelectedRow,
            segue.identifier == "gameDetailSegue" {
            detailViewController?.pastGame = games![indexPath.row]
        }
    }
}
