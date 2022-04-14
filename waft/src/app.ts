import { JSONObject } from "waft-json";
import { console, App } from "waft";
export class app extends App{
  
  onLaunch(options: JSONObject): void{
    super.onLaunch(options);
    console.log('app onLaunch');
  }
}