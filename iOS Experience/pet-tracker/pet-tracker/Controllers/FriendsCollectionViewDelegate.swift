//
//  FriendsCollectionViewDelegate.swift
//  pet-tracker
//
//  Created by Matthew Baker on 2/2/20.
//  Copyright © 2020 Matthew Baker. All rights reserved.
//

import UIKit

class FriendsCollectionViewDelegate: NSObject, UICollectionViewDelegateFlowLayout {
    var viewController: UIViewController
    
    let numberOfItemsPerRow:CGFloat
    let interItemSpacing:CGFloat
    let lineSpacing:CGFloat
    
    init(numberOfItemsPerRow:CGFloat, interItemSpacing:CGFloat, lineSpacing:CGFloat, viewController:UIViewController) {
        self.numberOfItemsPerRow = numberOfItemsPerRow
        self.interItemSpacing = interItemSpacing
        self.lineSpacing = lineSpacing
        self.viewController = viewController
    }
    
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, sizeForItemAt indexPath: IndexPath) -> CGSize {

        let maxWidth = collectionView.frame.width
        let totalInterItemSpacing = interItemSpacing * numberOfItemsPerRow
        let itemWidth = floor((maxWidth - totalInterItemSpacing) / numberOfItemsPerRow)
        let itemHeight = 285

        return CGSize(width: itemWidth, height: CGFloat(itemHeight))
    }
    
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, minimumInteritemSpacingForSectionAt section: Int) -> CGFloat {
        return interItemSpacing
    }

    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, minimumLineSpacingForSectionAt section: Int) -> CGFloat {
        return lineSpacing
    }
    
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, insetForSectionAt section: Int) -> UIEdgeInsets {
        return UIEdgeInsets(top: 15, left: 15, bottom: 0, right: 15)
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        if let currentController = viewController as? FriendsViewController {
            let cell = collectionView.cellForItem(at: indexPath)
            FriendsViewController.selectedFriend = FriendsViewController.friends[indexPath.item]
            currentController.performSegue(withIdentifier: "toPetsSegue", sender: cell)
        } else if viewController is PetsViewController {
            print("Clicked on a pet")
        }
    }

}
