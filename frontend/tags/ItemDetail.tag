<ItemDetail>

<div>
    <ul class="list-inline">
        <li>
            <img if="{ item.url1 }" src="./img/{ item.url1 }" width="100" height="120">
        </li>
        <li>
            <img if="{ item.url2 }" src="./img/{ item.url2 }" width="100" height="120">
        </li>
        <li>
            <img if="{ item.url3 }" src="./img/{ item.url3 }" width="100" height="120">
        </li>
        <li>
            <img if="{ item.url4 }" src="./img/{ item.url4 }" width="100" height="120">
        </li>
    </ul>

    <table class="table table-bordered">
        <tr>
            <td class="active">商品名</td>
            <td>{ item.item_name }</td>
        </tr>
        <tr>
            <td class="active">値段</td>
            <td>{ item.price }</td>
        </tr>
        <tr>
            <td class="active">説明</td>
            <td>{ item.description }</td>
        </tr>
        <tr>
            <td class="active">販売状況</td>
            <td>{ item.is_unbuyable }</td>
        </tr>
        <tr>
            <td class="active">いいね</td>
            <td>未実装</td>
        </tr>
        <tr>
            <td class="active">コメント</td>
            <td>未実装</td>
        </tr>
        <tr>
            <td class="active">カテゴリ</td>
            <td>{ item.main_category_name}＞{ item.sub_category_name }＞{ item.category_name }</td>
        </tr>
        <tr>
            <td class="active">サイズ</td>
            <td>{ item.size_name }</td>
        </tr>
        <tr>
            <td class="active">商品の状態</td>
            <td>{ item.status_name }</td>
        </tr>
    </table>
</div>

<script>
    const LOAD_URL = '/api/item/get?id=';

    this.assign = {
        id: ''
    }

    this.item = [];

    this.on('mount', function() {
        this.assign.id = id;
        console.log(this.assign);
        this._load();
    });

    _load(){
      $(function(){
          $.ajax({
                url:LOAD_URL + this.assign.id,
                type:'GET',
            })
            .done( (data) => {
                console.log('done!!!!');
                // アサイン方法変更
                this.item = data;
                this.update();
                console.log(this.item);

            })
            .fail( (data) => {
                console.log('fail!!!!');
                console.log(data);
            })
            .always( (data) => {
                console.log('getItemList finished');
            });
      }.bind(this));

    }

</script>

</ItemDetail>