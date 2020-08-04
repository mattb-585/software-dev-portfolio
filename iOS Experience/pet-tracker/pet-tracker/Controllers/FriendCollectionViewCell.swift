//
//  FriendCollectionViewCell.swift
//  pet-tracker
//
//  Created by Matthew Baker on 2/2/20.
//  Copyright © 2020 Matthew Baker. All rights reserved.
//

import UIKit

class FriendCollectionViewCell: UICollectionViewCell {
    static let reuseIdentifier = String(describing: FriendCollectionViewCell.self)
    
    @IBOutlet weak var friendImageView: UIImageView!
    @IBOutlet weak var friendNameLabel: UILabel!
    @IBOutlet weak var friendAddressLabel: UILabel!
    @IBOutlet weak var friendAgeLabel: UILabel!
    @IBOutlet weak var friendEyeColorLabel: UILabel!
    
}
