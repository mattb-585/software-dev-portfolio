//
//  PetCollectionViewCell.swift
//  pet-tracker
//
//  Created by Matthew Baker on 2/11/20.
//  Copyright © 2020 Matthew Baker. All rights reserved.
//

import UIKit

class PetCollectionViewCell: UICollectionViewCell {
    
    static let reuseIdentifier = String(describing: PetCollectionViewCell.self)
    
    @IBOutlet weak var petImage: UIImageView!
    @IBOutlet weak var petNameLabel: UILabel!
    @IBOutlet weak var speciesLabel: UILabel!
    @IBOutlet weak var dateOfBirthLabel: UILabel!
    
}
