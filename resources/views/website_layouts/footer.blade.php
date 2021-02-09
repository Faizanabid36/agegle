<footer class="footer">
    <div style="padding: 0px 0px 0px 0px">
        <div class="container">
            <div class="row">
                @foreach($pages as $page)
                    <div class="col-xs-3 col-md-3 col-md-3">
                        <div class="fa-container">
                            <img width="40" src="{{asset($page->page_icon)}}">
                        </div>
                        <a href="{{url($page->slug)}}" class="blue-color" style="text-decoration: none">
                            <p style="font-size: 16px;color: black" class="text-center txt txt1 btn-link blue-color">
                                {{$page->title}}
                            </p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</footer>
<script>
    const ASSET = "{{asset('')}}"
        function revertIcon(e) {
            let id = e.id
            document.getElementById(id).src = ASSET + 'website/assets/images/arrow.svg'
        }

    function activeIcon(e) {
        let id = e.id
        document.getElementById(id).src = ASSET + 'website/assets/images/blue.jpg'
        document.getElementById(id).style.cursor = 'pointer'
    }

    $(document).ready(function () {
        let page = 2;
        $('#see_more').click(function () {
            $.ajax({
                type: 'GET',
                url: "?page=" + page,
                success: function (data) {
                    page += 1;
                    if (data.html == 0) {
                        alert('No More Data Display')
                    } else {
                        $('#content').append($(data.html))
                        console.log(data.currentPage)
                        if (data.currentPage === data.lastPage)
                        {
                            $('#see_more').remove()
                        }
                    }
                }, error: function (data) {
                    console.log(data)
                },
            })
        })
        $('#submit_form_button').click(function (e) {
            e.preventDefault()
            $('#submit_form').submit()
        })
    })
</script>
