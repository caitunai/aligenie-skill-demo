import { JSON, JSONObject } from "waft-json";
import { console, getDataSource, Page, Props, Event, MessageEvent, setTimeout,window } from "waft";
export class Index extends Page {
  constructor(props: Props){
    super(props);
    // 获取query
    const query = this.query;
    // 获取dataSource
    const dataSource = this.dataSource;
    // 设置到state的示例
    this.setState(dataSource);
  }

  onMessage(e: MessageEvent): void{
    if (e.data.has("dataSource")) {
      const data = e.data.getObject("dataSource");
      this.setState(data);
    }
  }

  onPlus(e: Event): void{
    const percent = this.state.getInteger("percent");
    this.setState(JSON.parseObject(`{"percent": ${(percent + 1).toString()}}`));
  }

  onMinus(e: Event): void{
    const percent = this.state.getInteger("percent");
    this.setState(JSON.parseObject(`{"percent": ${(percent - 1).toString()}}`));
  }

  onShow(): void{
    // 页面显示
    console.log('page onShow');
  }

  onLoad(query: JSONObject): void{
    // 页面加载后
    console.log('page onLoad:' + JSON.stringify(query));
  }

  // 语音事件
  onVoice(data: JSONObject): void{}

  // 界面更新事件
  onUpdate(data: JSONObject): void{
    console.log("onUpdate:" + data.toString());
  }

  // 音频事件
  onAudio(data: JSONObject): void{}
}
