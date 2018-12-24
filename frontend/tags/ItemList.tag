<ItemList>

    <table class="table table-bordered" style="width: 500px">
        <tr>
            <td class="active">検索</td>
            <td>
                <input type="text" value="" onkeydown="{ changeName }" onkeyup="{ changeName }">
            </td>
        </tr>
        <tr>
            <td class="active">並び替え</td>
            <td>
                <select onchange="{ changeSort }">
                    <!-- TODO ↓コメントアウト箇所追記実装 -->
                    <!--<option value="">キーワード順</option>-->
                    <option value="0">新しい順</option>
                    <!--<option value="0">古い順</option>-->
                    <option value="1">価格の安い順</option>
                    <option value="2">価格の高い順</option>
                    <!--<option value="2">いいねの多い順</option>-->
                </select>
            </td>
        </tr>
        <tr>
            <td class="active">値段</td>
            <td>
                <input type="text" value="" onkeydown="{ changePrice.bind(this,'minPrice') }" onkeyup="{ changePrice.bind(this,'minPrice') }">
                〜
                <input type="text" value="" onkeydown="{ changePrice.bind(this,'maxPrice') }" onkeyup="{ changePrice.bind(this,'maxPrice') }">円
            </td>
        </tr>
        <tr>
            <td class="active">商品の状態</td>
            <td>
                <select onchange="{ changeStatus }">
                    <option value="1">新品、未使用</option>
                    <option value="2">未使用に近い</option>
                    <option value="3">目立った傷や汚れなし</option>
                    <option value="4">やや傷や汚れあり</option>
                    <option value="5">傷や汚れあり</option>
                    <option value="6">全体的に状態が悪い</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="active">販売状況</td>
            <td>
                <select onchange="{ changeSales }">
                    <option value="0">販売中</option>
                    <option value="1">売り切れ</option>
                </select>
            </td>
        </tr>
    </table>

    <ul class="list-inline">

        <li each="{ item in items }">
            <div>
                <img border="" src="./img/{ item.url1 }" width="120" height="130">
            </div>
            <div>
                <a href="/detail?id={ item.id }">{ item.name }</a>
            </div>
            <div>
                { item.price }円
            </div>
        </li>
    </ul>

<script>
    const SEARCH_URL = '/api/item/search';

    this.param = {
        name: '',
        sort: 'created_at',
        order: 'desc',
        main_category_id: null,
        sub_category_id: null,
        category_id: null,
        size: null,
        minPrice: null,
        maxPrice: null,
        status: null,
        is_unbuyable: null
    }

    this.items = [];

    this.on('mount', function() {
      this._search();
    });

    // 検索
    _search(){
      $(function(){
          $.ajax({
                url:SEARCH_URL,
                type:'POST',
                data:this.param
            })
            .done( (items) => {
                // アサイン方法変更
                this.items = items;
                this.update();
                console.log(this.items);

            })
            .fail( (data) => {
                console.log(data);
            })
            .always( (data) => {
                // console.log('getItemList finished');
            });
      }.bind(this));

    }

    // 商品名の変更
    changeName(e){
        var name = e.target.value;
        if (this.param['name'] != name) {
            console.log('call _search');
            this.param['name'] = name;
            this._search();
        }
    }

    // 並び替えの変更
    changeSort(e){
        var sortCode = e.target.value;

        switch (sortCode) {
            case '0':
                this.param['sort'] = 'created_at';
                this.param['order'] = 'desc';
                break;
            case '1':
                this.param['sort'] = 'price';
                this.param['order'] = 'asc';
                break;
            case '2':
                this.param['sort'] = 'price';
                this.param['order'] = 'desc';
                break;
            default:
                break;
        }

        this._search();
    }

    // 料金の変更
    changePrice(k, e){
        this.param[k] = e.target.value;
        this._search();
    }

    // カテゴリ
    changeCategory(){

    }

    // 状態
    changeStatus(e){
        this.param['status'] = e.target.value;
        this._search();
    }

    // 販売状況
    changeSales(e){
        this.param['is_unbuyable'] = e.target.value;
        this._search();
    }

</script>
</ItemList>