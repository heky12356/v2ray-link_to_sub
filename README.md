# v2ray-link_to_sub

一个简单的节点链接转化成订阅工具，用到sqlite数据库，可以在线添加节点，虽然叫做v2ray-link_to_sub，但本质上是读取数据库里面的节点然后一键转换成base64，所以理论上其他的协议例如tuic或者hysteria也可以用

### 功能介绍：

1. 订阅链接：点进去就是转换好的base64字符串，可以直接把网址复制下来，到nekobox还是v2rayn之类的软件里用
2. 查看节点链接：点进去可以看有多少个节点和哪些节点被加进去，现在只能看链接，以后可能会做查看名字和复制链接的功能
3. 添加节点：就是添加节点到数据库，添加完就可以不去管他了，到软件里面更新一下订阅就可以了
4. 查看数据库列表：就是查看数据库列表
5. 添加数据库：就是添加数据库
6. 添加外源订阅保存

### 演示网址：

https://sub.heky.top/

![image-20240704151246676](C:\Users\heky\AppData\Roaming\Typora\typora-user-images\image-20240704151246676.png)

> 订阅链接：https://sub.heky.top/sub.php?db=wky&sub=

### 使用须知：

1. 第一次使用需要给`'db'文件夹`，以及db文件夹内`otherurl.db`和`usrdb.db`写入权限
2. 需要先添加数据库后使用
3. 需要创建一个用户名为“admin”的用户才可以删除节点
4. 如果忘记admin的密码，可以删除usrdb.db，然后从源码处重新下载一个usrdb.db后覆盖，并重新创建admin用户
5. 通过 网址/src/php/usrview.php 来查看用户
6. 更新方式：直接覆盖
### 还未实现功能：

1. 在游客状态下隐藏数据库