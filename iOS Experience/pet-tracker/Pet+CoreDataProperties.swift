//
//  Pet+CoreDataProperties.swift
//  pet-tracker
//
//  Created by Matthew Baker on 3/16/20.
//  Copyright © 2020 Matthew Baker. All rights reserved.
//
//

import Foundation
import CoreData


extension Pet {

    @nonobjc public class func fetchRequest() -> NSFetchRequest<Pet> {
        return NSFetchRequest<Pet>(entityName: "Pet")
    }

    @NSManaged public var name: String?
    @NSManaged public var species: String?
    @NSManaged public var dateOfBirth: String?
    @NSManaged public var friend: Friend?

}
