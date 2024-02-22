@if($row->listing_type == 'Project' and $row->faqs_count > 0 )
    <div class="p-6 bg-neutral-0 rounded-4 mb-10">
        @if($title)
            <h2 class="def_h2_blocks">{{$title}}</h2>
        @endif
        <div class="container pt-2 pb-5 faq_container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="accordion accordion--separated accordion--secondary" id="accordionExample">
                        @foreach($row->faqs as $faq)
                            <div class="accordion-item">
                                <h3 class="accordion-header">
                                    <button class="accordion-button @if($loop->index != 0) collapsed @endif " type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$faq->id}}" aria-expanded="@if($loop->index == 0) true @endif" aria-controls="collapse_{{$faq->id}}">
                                        <span class="faq_question">{{$faq->question}}</span>
                                    </button>
                                </h3>
                                <div id="collapse_{{$faq->id}}" class="accordion-collapse collapse @if($loop->index == 0) show @endif" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {!! nl2br($faq->answer) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
