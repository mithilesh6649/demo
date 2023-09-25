@if ($maintenance_docs_count != 0)

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <!--    <div class="carousel-item active">
      <img class="d-block w-100" src="..." alt="First slide">
    </div> -->

            @foreach ($maintenance_docs as $key => $images)
                @if ($key == 0)
                    <div class="carousel-item active" show_image_id='{{ $key }}'>
                        <img class="d-block zoom_01" style="width: auto; height: 400px;margin:0px auto;"
                            src="{{ env('BRANCH_MAINTENANCE_DOC_PATH') . $images['doc'] }}" alt="{{ $images['doc'] }}"
                            data-zoom-image="{{ env('BRANCH_MAINTENANCE_DOC_PATH') . $images['doc'] }}">>
                    </div>
                @else
                    <div class="carousel-item show_image_id" show_image_id='{{ $key }}'>
                        <img class="d-block zoom_01" style="width: auto; height: 400px;margin:0px auto;"
                            src="{{ env('BRANCH_MAINTENANCE_DOC_PATH') . $images['doc'] }}" alt="{{ $images['doc'] }}"
                            data-zoom-image="{{ env('BRANCH_MAINTENANCE_DOC_PATH') . $images['doc'] }}">>
                    </div>
                @endif
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@else
    <div class="col-md-12 border text-center font-weight-bold">
        <p class='p-2'>Document Not Available</p>
    </div>

@endif

<script>
    $(document).ready(function() {
        $('.zoom_01').elevateZoom({
            // zoomType: "lens",
            // lensShape: "circle",
            // lensSize: 450,
             zoomType: "lens",
             lensShape: "circle",
             lensSize: 250,
        });

        // $(".zoom_01").elevateZoom({
        //     tint: true,
        //     tintColour: '#F90',
        //     tintOpacity: 0.5
        // });

    });
</script>
