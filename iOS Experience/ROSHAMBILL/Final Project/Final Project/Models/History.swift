//
//  History.swift
//  Final Project
//
//  Created by Matthew Baker on 12/2/19.
//  Copyright © 2019 Matthew Baker. All rights reserved.
//

import Foundation

//struct History:Codable {
//    var gameName:String
//    var playerAmount:Int
//    var winningNumber:Int
//    var guesses:[String]
//    var winner:Int
//
////    static let documentsDirectory =
////      FileManager.default.urls(for: .documentDirectory,
////      in: .userDomainMask).first!
////
////    static let archiveURL = documentsDirectory.appendingPathComponent("history").appendingPathExtension("plist")
////
////    static func saveToFile(pastGames:[History]) {
////        let propertyListEncoder = PropertyListEncoder()
////        let encodedHistory = try? propertyListEncoder.encode(pastGames)
////        try? encodedHistory?.write(to: archiveURL, options: .noFileProtection)
////    }
////
////    static func loadFromFile() -> [History]?{
////        var loadedHistory:[History] = []
////        let propertyListDecoder = PropertyListDecoder()
////        if let retrievedHistoryData = try? Data(contentsOf: archiveURL),
////            let decodedHistory = try?
////              propertyListDecoder.decode(Array<History>.self, from:
////              retrievedHistoryData) {
////            loadedHistory = decodedHistory
////        }
////        return loadedHistory
////    }
//}
