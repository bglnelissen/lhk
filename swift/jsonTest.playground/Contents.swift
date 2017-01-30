//: Goals

// Get data from the server in an elegant way
// - when collected, save data in dictionary
// - When partitially collected, stop and redo the collection
// - when no server is available, stop and tell the user

// Sources and info used:
// - developer.apple.com/swift/blog/?id=37
// - Learn Swift Online

// retrieve data
import Foundation
import PlaygroundSupport

var statusCode = 404;

// create an object that contains a URL
let url = URL(string: "https://guu.st/lhk/json.php")!

// make the request
let task = URLSession.shared.dataTask(with: url) {
  data, response, error in
  
  guard error == nil else {
    print(error)
    return
  }
  guard let data = data else {
    print("Data is empty")
    return
  }
  
  let json = try! JSONSerialization.jsonObject(with: data, options: [])
  print(json)
}


task.resume()
PlaygroundPage.current.needsIndefiniteExecution = true