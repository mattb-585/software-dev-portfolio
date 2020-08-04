//
//  Setting.swift
//  Final Project
//
//  Created by Matthew Baker on 11/27/19.
//  Copyright © 2019 Matthew Baker. All rights reserved.
//

import Foundation

struct Setting: Codable {
    var startingNumber:Int
    var endingNumber:Int
    
    static let documentsDirectory =
      FileManager.default.urls(for: .documentDirectory,
      in: .userDomainMask).first!
    
    static let archiveURL = documentsDirectory.appendingPathComponent("settings").appendingPathExtension("plist")
    
    static func saveToFile(setting:Setting) {
        let propertyListEncoder = PropertyListEncoder()
        let encodedSetting = try? propertyListEncoder.encode(setting)
        try? encodedSetting?.write(to: archiveURL, options: .noFileProtection)
    }
    
    static func loadFromFile() -> Setting?{
        var loadedSetting:Setting? = nil
        let propertyListDecoder = PropertyListDecoder()
        if let retrievedSettingData = try? Data(contentsOf: archiveURL),
            let decodedSetting = try?
              propertyListDecoder.decode(Setting.self, from:
              retrievedSettingData) {
            loadedSetting = decodedSetting
        }
        guard loadedSetting != nil else {return nil}
        
        return loadedSetting!
    }
}
