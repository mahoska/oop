<?php



class SimpleList{
    private $head;
    private $tail;
    private static $count;

    public function __construct()
    {
        $this->head = NULL;
        $this->tail = NULL;
	self::$count=0;
    }
    
    public function __destruct()
    {
        //echo "destruct","<br>";
    }
    
    public function add($data)//новый становится последним
    {
        $temp=new ListElement;//создаем новый элемент
	$temp->data=$data;//заполняем данными
	$temp->next=NULL;//следующий элемент отсутствует
	//новый элемент становится последним элементом списка,
        // если он не первый добавленный
	if($this->head!=NULL)
	{
		$this->tail->next=$temp;
		$this->tail=$temp;
	}
	//новый элемент становится единственным, если он первый добавленный
	else
	{
		$this->head=$this->tail=$temp;
	}
	self::$count++;
    }
    
    public function dell()//удаляется главный элемент
    {
	$this->head=$this->head->next;//перебрасываем голову на следующий элемент
	self::$count--;
    }
    
    public function dellAll()//удаляется весь список
    {
        while(!is_null($this->head))//пока есть элементы
		$this->dell();//удаляем по одному
    }
    
    public function __toString()//распечатка с головного элемента
    {
        $temp=$this->head;//запоминаем адрес головного элемента
        $listStr = "";
	while(!is_null($temp))//пока есть элементы
	{
		$listStr .= $temp->data." ";//выводим данные
		$temp=$temp->next;//переходим на следующий элемент
	}
	return $listStr;
    }
    
    public function getCount()
    {
        return self::$count;
    }
    
    public function insert(ListElement $befor,$value)//вставка элемента в заданную позицию
    {
        $cons=new ListElement;//создаем новый элемент
	$cons->data=$value;//заполняем нашими данными
	$poz=$this->head;//начинаем поиск заданной позиции с головы
	$temp=NULL;
	while($poz->next!=$befor)//если позиция не искомая
            $poz=$poz->next;//продолжаем двигатся по списку
	if($poz->next==$befor)
	{
            $temp=$poz->next;//вставка
            $poz->next=$cons;
            $cons->next=$temp;
            self::$count++;
	}
    }
    
    public function dellPoz(ListElement $del)//удаление эл-та  по заданной позиции
    {
        $poz=clone($this->head);
	while($poz->next!=$del)
            $poz=$poz->next;
	if($poz->next==$del)
	{
		$poz->next=$del->next;
		self::$count--;
	}
    }
    
    public function search($value)//поиск заданного элемента
    {
        $poz=$this->head;
	if($poz==NULL) return NULL;
	else
	{
		while($poz->data!=$value && $poz->next!=NULL)
                    $poz=$poz->next;
                
                if($poz->data==$value)
                    return $poz;
                else return NULL;
                
	}
    }
    
    public function __clone(){
        self::$count++;
    }
}

