using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Reader.Model
{
    public class ComboDataModel
    {
        public ModelData[] successCardType
        {
            get;
            set;
        }

        public ModelData[] successGroup
        {
            get;
            set;
        }
    }
    

    public class ModelData
    {
        public int id
        {
            get;
            set;
        }

        public string name
        {
            get;
            set;
        }
    }
}
