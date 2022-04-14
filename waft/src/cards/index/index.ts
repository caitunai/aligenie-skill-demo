import { JSON, JSONObject } from "waft-json";
import { console, getDataSource, Page, Props, Event, MessageEvent } from "waft";

// 支持class写法
let _this: Index;
export class Index extends Page {
  percent: i32 = 42;
  constructor(props: Props){
    super(props);
    _this = this;
    // 设置默认的state
    this.setState(getDataSource());
    // 添加监听事件
    this.addEventListener("plus", (event: Event)=>{
      _this.setState(JSON.parseObject(`{"percent": "${(_this.percent++).toString()}%"}`));
    });
    this.addEventListener("minus", (event: Event)=>{
      _this.setState(JSON.parseObject(`{"percent": "${(_this.percent--).toString()}%"}`));
    });
  }
  onShow(): void{
    // 页面显示
    console.log('page onShow');
  }
  onLoad(query: JSONObject): void{
    // 页面加载后
    console.log('page onLoad:' + JSON.stringify(query));
  }
  onMessage(event: MessageEvent): void{
    // 信息推送更新
    console.log('page onMessage:' + JSON.stringify(event.data));
    // 如果需要进行更新界面
    if(event.data.has("dataSource")){
      this.setState(event.data.getObject("dataSource"));
    }
  }
}




