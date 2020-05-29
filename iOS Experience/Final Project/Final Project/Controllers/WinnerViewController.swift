//
//  WinnerViewController.swift
//  Final Project
//
//  Created by Matthew Baker on 12/2/19.
//  Copyright © 2019 Matthew Baker. All rights reserved.
//

import UIKit

class WinnerViewController: UIViewController {
    
    var winningPlayer:Int?
    @IBOutlet weak var winningPlayerLabel: UILabel!
    
    override func viewDidLoad() {
        super.viewDidLoad()

        winningPlayerLabel.text = "PLAYER \(winningPlayer!) WINS!"

        // Do any additional setup after loading the view.
        
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
