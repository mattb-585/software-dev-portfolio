//
//  History+CoreDataProperties.swift
//  Final Project
//
//  Created by Matthew Baker on 3/18/20.
//  Copyright © 2020 Matthew Baker. All rights reserved.
//
//

import Foundation
import CoreData


extension History {

    @nonobjc public class func fetchRequest() -> NSFetchRequest<History> {
        return NSFetchRequest<History>(entityName: "History")
    }

    @NSManaged public var gameName: String?
    @NSManaged public var playerAmount: Int16
    @NSManaged public var winningNumber: Int16
    @NSManaged public var guesses: String?
    @NSManaged public var winner: Int16
    @NSManaged public var date: Date?

}
