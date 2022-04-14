import { Event, Props, console, Component, Target } from "waft";
import { JSON, JSONObject } from "waft-json";

export class XButton extends Component{
  constructor(props: Props){
    super(props);
  }

  buttonClick(e: Event): void{
    this.props.dispatch("onTap");
  }

  deriveDataFromProps(nextProps: JSONObject): void{
    console.log("props:" + nextProps.toString());
  }

  willMount(attribute: JSONObject):void{
    console.log('component willMount:' + attribute.toString());
  }

  didMount():void{
    console.log('component didMount');
  }

  didUnmount():void{
    console.log('component didUnmount');
  }
}